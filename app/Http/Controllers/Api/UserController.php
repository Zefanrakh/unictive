<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use App\Services\Api\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function currentUser(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function index(Request $request)
    {
        $perPage = min($request->query('per_page', 10), 50);
        $sortBy = $request->query('sort', 'name');
        $order = $request->query('order', 'asc');
        $users = User::with('hobbies')
            ->orderBy($sortBy, $order)
            ->paginate($perPage);
        return new UserResourceCollection($users);
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->all();
        $response = $this->userService->createUser($data);

        return response()->json(collect($response)->only(['message', 'user']), 201);
    }

    public function show($user)
    {
        return new UserResource($user->load('hobbies'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->only(['name', 'email', 'password', 'hobbies']);
        $updatedUser = $this->userService->updateUserWithHobbies($user, $data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => new UserResource($updatedUser),
        ], 200);
    }

    public function destroy(User $user)
    {
        $response = $this->userService->deleteUser($user);
        return response()->json($response, 200);
    }
}
