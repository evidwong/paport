<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ProxyHelpers;
use App\User;
use Auth;

class OAuthController extends Controller
{
	use ProxyHelpers;
    public function access_token(Request $request)
	{
        // $needs = $this->validate($request, rules('login'));

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw new UnauthorizedException('此用户不存在');
        }

        $tokens = $this->authenticate();

        return succeed(['token' => $tokens, 'user' =>$user->toArray()]);
	}

	public function refresh_token(){
		$tokens=$this->refresh();
		return succeed(['token' => $tokens]);
	}
	public function getInfo(){
		$user=Auth::user();
		return succeed($user->toArray());
	}
}
