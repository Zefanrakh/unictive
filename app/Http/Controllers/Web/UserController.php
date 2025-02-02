<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Services\Web\UserService;
use App\Traits\DefaultApiResponseHandler;
use App\View\Components\auth;
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

    public function index(Request $request)
    {
        try {
            $response = $this->userController->index($request);
            if (method_exists($response, 'status')) {
                return back()->with('message', [
                    'type' => 'error',
                    'content' => 'Failed to fetch users from the server. Status: ' . $response->status()
                ]);
            }

            $data = $response->toArray($request);
            $links = [
                'first' => $response->url(1),
                'last' => $response->url($response->lastPage()),
                'prev' => $response->previousPageUrl(),
                'next' => $response->nextPageUrl(),
            ];
            $meta = [
                'current_page' => $response->currentPage(),
                'from' => $response->firstItem(),
                'last_page' => $response->lastPage(),
                'per_page' => $response->perPage(),
                'to' => $response->lastItem(),
                'total' => $response->total(),
            ];
            return view('users.index', compact('data', 'links', 'meta'));
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
            $createUserRequest = CreateUserRequest::createFrom($request);
            $response = $this->userController->create($createUserRequest);
            if ($response->status() !== 201 && $response->status() !== 200) {
                return $this->handleApiErrorRedirect($response->getData()->message);
            }

            $user = $response->getData()->user ?? [];
            return redirect()->route("users.show", ["user" => $user->id]);
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
            $response = $this->userController->show($user);

            return $this->userService->showUser($request, $response);
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

    public function profile(Request $request)
    {
        try {
            $response = $this->userController->show(auth()->user());

            return $this->userService->showUser($request, $response);
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
            $response = $this->userController->destroy($user);
            if ($response->status() !== 201 && $response->status() !== 200) {
                return $this->handleApiErrorRedirect($response->getData()->message);
            }

            return redirect()->route("users.index")->with('message', [
                'type' => 'success',
                'content' => $response->getData()->message ?? 'Delete user successfully!',
            ]);
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }
}
