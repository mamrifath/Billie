<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Invalid End-Point !',
                ], 404);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 422,
                    'message' => $e->getMessage(),
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        $this->renderable(function (Exception $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 500,
                    'message' => $e->getMessage(),
                ], 500);
            }
        });
    }
}
