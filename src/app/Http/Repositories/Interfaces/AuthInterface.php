<?php

namespace Repositories\Interfaces;

use \Illuminate\Http\Request;

interface AuthInterface
{
    public function createToken(string $key = '');

    public function getAccessToken(Request $request);
}



