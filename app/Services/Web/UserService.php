<?php

namespace App\Services\Web;

use App\Http\Controllers\Api\UserController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\DefaultApiResponseHandler;
use Illuminate\Http\Request;

class UserService
{
    use DefaultApiResponseHandler;

    protected $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function indexUsers()
    {
        $response = $this->index();
        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }
        $responseData = $response->getData();
        $data = $responseData->data;
        $links = $responseData->links;
        $meta = $responseData->meta;
        return view('users.index', compact('data', 'links', 'meta'));
    }

    public function showUser(User $user)
    {
        $response = $this->show($user);

        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }

        $responseData = $response->getData();
        $user = $responseData->data ?? [];
        return view('profile', compact('user'));
    }

    public function createUser(Request $request)
    {
        $response = $this->create($request);
        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }

        $responseData = $response->getData();
        $user = $responseData->user ?? [];
        return redirect()->route("users.show", ["user" => $user->id]);
    }

    public function updateUser(Request $request, User $user)
    {
        $response = $this->update($request, $user);
        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }

        $responseData = $response->getData();
        $user = $responseData->user ?? [];
        return back()->with('message', [
            'type' => 'success',
            'content' => 'User updated successfully.'
        ])->with('user', $user);
    }

    public function destroyUser(User $user)
    {
        $response = $this->destroy($user);
        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }

        return redirect()->route("users.index")->with('message', [
            'type' => 'success',
            'content' => $response->getData()->message ?? 'Delete user successfully!',
        ]);
    }

    // Direct to API

    private function index()
    {
        $response = app(UserController::class)->index(request());
        return $response->toResponse(request());
    }

    private function create(Request $request)
    {
        $createUserRequest = CreateUserRequest::createFrom($request);
        return $this->userController->create($createUserRequest);
    }

    private function update(Request $request, User $user)
    {
        $updateUserRequest = UpdateUserRequest::createFrom($request);
        return $this->userController->update($updateUserRequest, $user);
    }

    private function show(User $user)
    {
        $response = app(UserController::class)->show($user);
        return $response->toResponse(request());
    }

    private function destroy(User $user)
    {
        return  $this->userController->destroy($user);
    }
}
