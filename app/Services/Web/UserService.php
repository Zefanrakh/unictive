<?php

namespace App\Services\Web;

use App\Http\Controllers\Api\UserController;
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

    public function showUser(Request $request, UserResource $response)
    {
        if (method_exists($response, 'status')) {
            return back()->with('message', [
                'type' => 'error',
                'content' => 'Failed to fetch profile. Status: ' . $response->status()
            ]);
        }

        $user = $response->toArray($request) ?? [];
        return view('profile', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $updateUserRequest = UpdateUserRequest::createFrom($request);
        $response = $this->userController->update($updateUserRequest, $user);

        if ($response->status() !== 201 && $response->status() !== 200) {
            return $this->handleApiErrorRedirect($response->getData()->message);
        }

        $user = $response->getData()->user ?? [];
        return back()->with('message', [
            'type' => 'success',
            'content' => 'User updated successfully.'
        ])->with('user', $user);
    }
}
