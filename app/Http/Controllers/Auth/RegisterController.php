<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\Auth\RegisterRepositoryInterface;

class RegisterController extends Controller
{
    private $registerRepository;

    public function __construct(RegisterRepositoryInterface $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->registerRepository->create($request->all());
        return response()->json(['data' => $user,'errors' => []],200);
    }
}
