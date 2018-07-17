<?php

namespace App\Http\Controllers\Traits;

use GuzzleHttp\Client;
use App\Exceptions\ApiHandler;
use GuzzleHttp\Exception\RequestException;

trait ProxyHelpers
{
    public function authenticate()
    {
        $http = new Client();

        try {
            $url = request()->root() . '/api/oauth/token';

            $params = array_merge(config('passport.proxy'), [
                'username' => request('email'),
                'password' => request('password'),
            ]);
            $respond = $http->post($url, ['form_params' => $params]);

        } catch (RequestException $exception) {
            // dd($exception);
            throw  new ApiHandler('请求失败，服务器错误');
        }

        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }
        throw new ApiHandler('账号或密码错误');
    }
    public function refresh(){
        $http = new Client();

        try {
            $url = request()->root() . '/api/oauth/token';

            $params = array_merge(config('passport.proxy'), [
                'grant_type' => 'refresh_token',
                'refresh_token' => request('refresh_token'),
            ]);
            // dd($params);
            $respond = $http->post($url, ['form_params' => $params]);

        } catch (RequestException $e) {
            // dd($exception->getCode());
            if ($e->getCode()===500) {
                # System error
                throw  new ApiHandler('System error',-1);
            }elseif ($e->getCode()===401) {
                # Unauthorized
                throw  new ApiHandler('Unauthorized',401);
            }elseif ($e->getCode()===404) {
                # Not Found
                throw  new ApiHandler('Not Found',404);
            }else{
                # Unkown
                throw  new ApiHandler('Unkown',-1);
            }
        }

        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }
        throw new ApiHandler('refresh token error');
    }
}