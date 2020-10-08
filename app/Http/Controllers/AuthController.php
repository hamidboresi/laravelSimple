<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:10',
            'hamid' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return response()->json(['data' => [],'errors' => $messages],422);
        }
        $user = User::create($request->all());

        return response()->json(['data' => $user,'errors' => []],200);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return response()->json(['data' => [],'errors' => $messages],422);
        }
        $user = User::where('email',$request->email)
        ->first();
        if(Hash::check($request->password, $user->password ?? null))
        {
            $user->api_token = Str::random(60);
            $user->save();
            return response()->json(['data' => $user,'errors' => []],200);
        }
        else
        {
            return response()->json(['data' => [],'errors' => ['email' => ['ایمیل یا پسورد اشتباه است']]],401);
        }
    }

    public function logout(Request $request)
    {
        $user = User::where('api_token',$request->header('api_token'))
        ->update(['api_token' => NULL]);
        return response()->json(['data' =>[],'errors' => []]);
    }
}
