<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
// use ApiException;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        dd($exception instanceof ApiHandler);
        if ($exception instanceof ApiHandler){
            dd(123);
            $result = [
                "msg" =>$exception->getMessage(),
                "code"=>$exception->getCode()
            ];
            return response()->json($result);
        }
        return parent::render($request, $exception);
    }
    /*protected function unauthenticated($request, AuthenticationException $exception)
    {   
        if($request->expectsJson()){
            $response=response()->json([
                    'errcode'=>401,
                    'errmsg' => $exception->getMessage()
                ], 200);
        }else{
            $response=redirect()->guest(url('/login'));
        }
        return $response;
    }*/
}
