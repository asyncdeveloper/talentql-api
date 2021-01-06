<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e) {
        if($request->wantsJson()) {
            if ($e instanceof AuthorizationException)
                return response()->json([ 'message' => 'Unauthorized' ],Response::HTTP_FORBIDDEN);

            if ($e instanceof MethodNotAllowedHttpException)
                return response()->json([ 'message' => 'Request method is invalid' ],Response::HTTP_METHOD_NOT_ALLOWED);

            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException)
                return response()->json([ 'message' => 'Resource not found' ],Response::HTTP_NOT_FOUND);

            //return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $e);
    }
}
