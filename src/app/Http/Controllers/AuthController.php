<?php

namespace App\Http\Controllers;

use App\City;
use App\Plan;
use App\User;
use Illuminate\Http\Request;
use Repositories\Interfaces\AuthInterface;

class AuthController extends Controller
{
    protected $tokenRepo;

    /**
     * AuthController constructor.
     * @param AuthInterface $token
     */
    public function __construct(AuthInterface $token)
    {
        $this->tokenRepo = $token;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function accessToken(Request $request)
    {
        if (!$request->isJson())
            return response('Bad request!', 400);

        $this->validate($request, [
            'email'      => 'required|min:6|max:255',
            'secret'     => 'required|min:32|max:32',
            'session_id' => 'required|min:16|max:128',
            'token_type' => 'required',
        ]);

        return $this->tokenRepo->getAccessToken($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email'            => 'required|email|unique:users',
            'language'         => 'required|string',
            'timezone'         => 'required',
            'operating_system' => 'required',
            'city'             => 'required|string|exists:cities,name',// assume user's city is one of the cities on database to give weather forecast
        ]);
        $user = User::create([
            'email'            => $request->email,
            'language'         => $request->language,
            'timezone'         => $request->timezone,
            'operating_system' => $request->operating_system,// $request->server('HTTP_USER_AGENT');
            'plan_id'          => Plan::where('is_default', 1)->first()->id,
            'city_id'          => City::where('name', $request->city)->first()->id,
        ]);
        return response()->json($user, 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->update($request->all());
        return response()->json($user);
    }

}
