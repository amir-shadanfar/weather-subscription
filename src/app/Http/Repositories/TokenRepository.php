<?php

namespace Touristalia\Auth\Repositories;

use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use Repositories\Interfaces\AuthInterface;
use Cache;

class TokenRepository implements AuthInterface
{
    const expireTime = 3600;

    public function createToken($key = '')
    {
        return Hash::make($key . time());
    }

    public function GetAccessToken(Request $request)
    {
        $where[] = ['username', '=', $request->json()->get('username')];
        $where[] = ['password', '=', $request->json()->get('secret')];
        $where[] = ['status', '=', '1'];

        $user = DB::table('touristalia_entry.staff')
            ->select('staff_id', 'access_token', 'name', 'surname', 'role_id', 'mail')
            ->where($where)
            ->limit(1)
            ->get();

        //Kullanıcı bilgileri hatalı ise 401 döndür
        if ($user->isEmpty())
            return (new Response('401 Unauthorized', 401));

        //Yeni token oluştur
        $access_token = $this->createToken($user[0]->staff_id);

        //Yeni token oluşturulmadan önce daha önceki tokenı sil
        //Bu işlem açık oturumların sonlanmasını sağlar.
        RedisHelpers::deleteValueFromKey($user[0]->access_token);

        //Yeni access token' ı redis e yaz
        RedisHelpers::setValueWithTtl($access_token,
            ['sesionId' => $request->json()->get('session_id'),
             'staffId'  => $user[0]->staff_id,
             'roleId'   => $user[0]->role_id,
             'name'     => $user[0]->name,
             'surname'  => $user[0]->surname,
             'mail'     => $user[0]->mail],
            self::expireTime);

        //Staff tablosuna token ı yaz
        DB::table('touristalia_entry.staff')
            ->where('staff_id', $user[0]->staff_id)
            ->update(
                ['access_token' => $access_token,
                 'session_id'   => $request->json()->get('session_id'),
                 'ip'           => $request->ip(),
                 'browser'      => $request->header('User-Agent'),
                 'login_time'   => date('Y-m-d H:i:s'),
                 'token_expire' => date('Y-m-d H:i:s', time() + 3600)]
            );

        return ['access_token' => $access_token,
                'userName'     => $user[0]->name . ' ' . $user[0]->surname,
                'roleId'       => $user[0]->role_id,
                'expireTime'   => date('Y-m-d H:i:s', time() + 3600)
        ];
    }
}

