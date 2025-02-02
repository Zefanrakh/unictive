<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Web\UserService;
use App\Traits\DefaultApiResponseHandler;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use DefaultApiResponseHandler;

    protected $userController;
    protected $userService;

    public function __construct(ApiUserController $userController, UserService $userService)
    {
        $this->userController = $userController;
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            return $this->userService->indexUsers();
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function showCreateForm(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            return $this->userService->createUser($request);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function show(Request $request, User $user)
    {
        try {
            if ($user->id == auth()->user()->id) {
                return redirect()->route('profile');
            }

            return $this->userService->showUser($user);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            return $this->userService->updateUser($request, $user);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function profile()
    {
        try {
            return $this->userService->showUser(auth()->user());
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();
            return $this->userService->updateUser($request, $user);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function destroy(Request $request, User $user)
    {
        try {
            return $this->userService->destroyUser($user);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }
}
