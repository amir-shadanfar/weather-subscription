<?php

namespace Touristalia\Auth\Repositories;

use App\User;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Support\Facades\Hash;
use Repositories\Interfaces\AuthInterface;
use Cache;

class TokenRepository implements AuthInterface
{
    const expireTime = 900;// 15 min

    public function createToken($key = '')
    {
        return Hash::make($key . time());
    }

    public function GetAccessToken(Request $request)
    {
        $where[] = ['email', '=', $request->json()->get('username')];
        $where[] = ['password', '=', $request->json()->get('secret')];

        $user = User::where($where)->first();
        if (is_null($user))
            return (new Response('401 Unauthorized', 401));

        $access_token = $this->createToken($user->id);

        // remove key from redis
        Cache::pull($user->access_token);

        // update cache
        Cache::put($access_token,
            [
                'sessionId' => $request->json()->get('session_id'),
                'userId'    => $user->id,
                'mail'      => $user->mail,
            ],
            self::expireTime);

        User::where('id', $user->id)->update(
            [
                'access_token' => $access_token,
                'session_id'   => $request->json()->get('session_id'),
                'ip'           => $request->ip(),
                'browser'      => $request->header('User-Agent'),
                'token_expire' => date('Y-m-d H:i:s', time() + 900)
            ]
        );

        return [
            'access_token' => $access_token,
            'email'        => $user->email,
            'expireTime'   => date('Y-m-d H:i:s', time() + 900)
        ];
    }
}

