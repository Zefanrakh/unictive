<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\UserService;
use Exception;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request, $role = null)
    {
        DB::beginTransaction();

        try {
            $data = $request->only(['name', 'email', 'password']);
            $data["role"] = $role ?? 'admin';

            $response = $this->userService->createUser($data);

            return response()->json($response, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
