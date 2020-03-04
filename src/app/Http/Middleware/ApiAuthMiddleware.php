<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use \Illuminate\Support\Facades\Cache;

class ApiAuthMiddleware
{
    protected $userId;

    public static function getId()
    {
        if (defined('userId'))
            return userId;
    }

    public function handle($request, Closure $next)
    {
        // retrieval from redis
        $session = Cache::get($request->header('Access-Token'));

        if (!empty($session) && $session['session'] == $request->header('Session-Id')) {
            define('userId', $session['userId']);
            return $next($request);
        }

        $user = User::where('access_token', $request->header('Access-Token'))
            ->where('session_id', $request->header('Session-Id'))
            ->where('token_expire', '>', date('Y-m-d H:i:s'))
            ->first();

        if (is_null($user))
            return response('Unauthorized.', 401);

        define('userId', $user->id);

        Cache::put($request->header('Access-Token'), [
            'session' => $request->header('Session-Id'),
            'userId'  => $user->id,
            'mail'    => $user->mail,
        ], 900); // 15 Minutes

        return $next($request);
    }
}
