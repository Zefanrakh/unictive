<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\UserService;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request, $role = null)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data["role"] = $role ?? 'admin';

        $response = $this->userService->createUser($data);

        return response()->json($response, 201);
    }
}
