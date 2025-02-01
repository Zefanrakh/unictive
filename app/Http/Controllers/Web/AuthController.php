<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\DefaultApiResponseHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use DefaultApiResponseHandler;

    protected $loginController;
    protected $registerController;

    public function __construct(LoginController $loginController, RegisterController $registerController)
    {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (auth()->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('dashboard')->with('message', [
                    'type' => 'success',
                    'content' => 'Login successful!',
                ]);
            }

            return back()->with('message', [
                'type' => 'error',
                'content' => 'Invalid credentials.',
            ]);

            return $this->handleApiRedirect($response, 'dashboard', 'Login failed.');
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $registerRequest = RegisterRequest::createFrom($request);
            $response = $this->registerController->register($registerRequest);
            return $this->handleApiRedirect($response, 'auth.login', 'Registration failed.');
        } catch (Exception $e) {
            return $this->handleApiErrorRedirect($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('message', [
            'type' => 'success',
            'content' => 'You have been logged out successfully.'
        ]);
    }
}
