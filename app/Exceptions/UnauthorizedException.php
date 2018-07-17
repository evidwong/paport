<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
	/*protected $errors = [
        -1   => 'system error' ,
        401   => 'Unauthorized' ,
    ];*/
    public function render($request, Exception $exception)
    {
    	$response = [];
    	$response['msg']=empty($exception->getMessage()) ? 'system error' : $exception->getMessage();
    	$response['code'] = empty($exception->getCode())?-1:$exception->getCode();
        response()->json($response,200);
        return parent::render($request, $exception);
    }
}
