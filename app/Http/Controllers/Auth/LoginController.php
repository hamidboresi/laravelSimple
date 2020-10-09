<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\Auth\LoginRepositoryInterface;

class LoginController extends Controller
{

    private $loginRepository;

    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(LoginRequest $request)
    {
        if($user = $this->loginRepository->checkPassword($request->email,$request->password))
        {
            $user = $this->loginRepository->updateToken($user);
            return response()->json(['data' => $user,'errors' => []],200);
        }
        else
        {
            return response()->json(['data' => [],'errors' => ['email' => ['ایمیل یا پسورد اشتباه است']]],401);
        }
    }
}
