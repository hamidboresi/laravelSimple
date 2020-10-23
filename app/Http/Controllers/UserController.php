<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        return response()->json(['data' => $user,'errors' => []]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        User::where('api_token',$request->bearerToken())->update($request->all());
        $user = User::where('api_token',$request->bearerToken())->first();
        return response()->json(['data' => $user,'errors' => []]);
    }
}
