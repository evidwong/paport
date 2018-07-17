<?php

namespace App\Exceptions;

use Exception;

class ApiHandler extends Exception
{
	public function report()
    {
    }
    public function render($request)
    {
    	$response = [];
    	$response['msg']=empty($this->getMessage()) ? 'system error' : $this->getMessage();
    	$response['code'] = empty($this->getCode())?-1:$this->getCode();
        return response()->json($response,200);
    }
}