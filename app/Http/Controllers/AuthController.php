<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return response()->json(['data' => $user,'errors' => []],200);
    }

    public function login(LoginRequest $request)
    {
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
