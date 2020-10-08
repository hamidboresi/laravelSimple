<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
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
}
