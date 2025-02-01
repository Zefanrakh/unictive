<?php

namespace App\Exceptions;

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
        if ($request->expectsJson()) {
            $status = 500; // Default status code

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
            } else {
                $response = [
                    'message' => 'An unexpected error occurred.',
                    'errors' => config('app.debug') ? $exception->getMessage() : null,
                ];
            }

            if (config('app.debug')) {
                $response['trace'] = $exception->getTrace();
            }

            return response()->json($response, $status);
        }

        // Fallback to default render for non-JSON requests
        return parent::render($request, $exception);
    }
}
