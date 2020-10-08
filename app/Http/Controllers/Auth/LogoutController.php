<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    private  $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function logout(Request $request)
    {
        $this->userRepository->removeToken($request);
        return response()->json(['data' =>[],'errors' => []]);
    }
}
