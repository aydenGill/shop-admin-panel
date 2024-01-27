<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->handleApiNotFound($exception);
            }
        });

        $this->renderable(function (Throwable $exception, $request) {
            if ($request->is('api/*') && $exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->handleUnauthenticated($exception);
            }
        });
    }

    /**
     * Handle the API not found exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleApiNotFound(NotFoundHttpException $exception)
    {
        return response()->json([
            'result' => null,
            'status' => false,
            'alert' => [
                'title' => 'Not Found',
                'message' => 'Record not found.',
            ],
        ], 404);
    }

    /**
     * Handle the unauthenticated exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleUnauthenticated(Throwable $exception)
    {
        return response()->json([
            'result' => null,
            'status' => false,
            'alert' => [
                'title' => 'Unauthenticated',
                'message' => 'Unauthenticated.',
            ],
        ], 401);
    }
}
