<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Override default render
     */
    public function render($request, Throwable $exception)
    {
        // Handle JSON requests
        if ($request->expectsJson()) {
            $response = $this->handleJsonExceptions($exception);
            return response()->json($response['body'], $response['status']);
        }

        // Fallback to default render for non-JSON requests
        return parent::render($request, $exception);
    }

    /**
     * Handle exceptions for JSON requests.
     */
    protected function handleJsonExceptions(Throwable $exception): array
    {
        $status = 500; // Default status code
        $response = ['message' => 'An unexpected error occurred.'];

        if ($exception instanceof ValidationException) {
            $status = 422;
            $response = [
                'message' => 'Validation failed.',
                'errors' => $exception->errors(),
            ];
        } elseif ($exception instanceof QueryException) {
            $status = 400;
            $response = [
                'message' => 'A database error occurred.',
                'errors' => [
                    'details' => $exception->getMessage(),
                ],
            ];
        } elseif ($exception instanceof NotFoundHttpException) {
            $status = 404;
            $response = [
                'message' => 'Resource not found.',
            ];
        } elseif ($exception instanceof AuthenticationException) {
            $status = 401;
            $response = [
                'message' => 'Unauthenticated.',
            ];
        } else {
            if (config('app.debug')) {
                $response['errors'] = $exception->getMessage();
                $response['trace'] = $exception->getTrace();
            }
        }

        return ['status' => $status, 'body' => $response];
    }
}
