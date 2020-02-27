<?php

namespace App\Http\Controllers;

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
     */
    public function register(Request $request)
    {

    }

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request)
    {

    }

}
