<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    
	use ApiResponser;
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
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

	public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'error' => "Model not found"
            ],Response::HTTP_NOT_FOUND);
        }
        if($exception instanceof NotFoundHttpException){
            return response()->json([
                'error' => "Path not found"
            ],Response::HTTP_NOT_FOUND);
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return response()->json([
                'error' => "Invalid Method"
            ],Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $exception);
    }
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
}
