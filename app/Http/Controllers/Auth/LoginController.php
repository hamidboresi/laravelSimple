<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repository\UserRepositoryInterface;

class LoginController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        if($user = $this->userRepository->checkPassword($request->email,$request->password))
        {
            $user = $this->userRepository->updateToken($user);
            return response()->json(['data' => $user,'errors' => []],200);
        }
        else
        {
            return response()->json(['data' => [],'errors' => ['email' => ['ایمیل یا پسورد اشتباه است']]],401);
        }
    }
}
