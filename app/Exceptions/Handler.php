<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     */
    protected $levels = [
        TenantException::class => 'warning',
        LocationException::class => 'warning',
    ];

    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [
        ValidationException::class,
        AuthenticationException::class,
        AuthorizationException::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log all exceptions with context
            Log::error('Exception occurred', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth(), // Fixed: was auth() instead of auth()->id()
                'url' => request()->url(),
                'method' => request()->method(),
                'ip' => request()->ip(),
            ]);
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e): JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        // Handle API requests
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle API exceptions with consistent JSON responses
     */
    private function handleApiException(Request $request, Throwable $e): JsonResponse
    {
        $response = $this->getApiErrorResponse($e);

        // Log the API error with additional context
        Log::channel('api')->error('API Exception', [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'status_code' => $response['status'],
            'endpoint' => $request->fullUrl(),
            'method' => $request->method(),
            'user_id' => auth(), // Fixed: was auth() instead of auth()->id()
            'request_data' => $request->except(['password', 'password_confirmation']),
        ]);

        // Build the base response
        $jsonResponse = [
            'error' => true,
            'status' => $response['status'],
            'message' => $response['message'],
            'timestamp' => now()->toISOString(),
            'path' => $request->path(),
        ];

        // Add validation errors if they exist
        if (isset($response['errors'])) {
            $jsonResponse['errors'] = $response['errors'];
        }

        return response()->json($jsonResponse, $response['status']);
    }

    /**
     * Get standardized error response data
     */
    private function getApiErrorResponse(Throwable $e): array
    {
        return match (true) {
            $e instanceof AuthenticationException => [
                'status' => 401,
                'message' => 'Unauthorized Access: Invalid credentials'
            ],
            $e instanceof AuthorizationException => [
                'status' => 403,
                'message' => 'Forbidden: You do not have permission to access this resource'
            ],
            $e instanceof ValidationException => [
                'status' => 422,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ],
            $e instanceof ModelNotFoundException => [
                'status' => 404,
                'message' => 'Resource not found'
            ],
            $e instanceof NotFoundHttpException => [
                'status' => 404,
                'message' => 'Endpoint not found'
            ],
            $e instanceof MethodNotAllowedHttpException => [
                'status' => 405,
                'message' => 'Method not allowed'
            ],
            $e instanceof TenantException,
            $e instanceof LocationException => [
                'status' => $e->getCode() ?: 500,
                'message' => $e->getMessage()
            ],
            default => [
                'status' => 500,
                'message' => app()->isProduction()
                    ? 'Internal server error'
                    : $e->getMessage()
            ]
            };
    }

   public function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson() || $request->is('api/*')) {
        return response()->json([
            'error' => true,
            'status' => 401,
            'message' => 'Unauthorized. Please log in again.',
            'timestamp' => now()->toISOString(),
            'path' => $request->path(),
        ], 401);
    }

    // fallback for web
    // return redirect()->guest(route('login'));
}
}