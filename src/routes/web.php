<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
     return $router->app->version();
});


$router->group(['prefix' => 'api/v1'], function ($router) {
    // without authentication
    $router->post('user/access_token', 'AuthController@accessToken');
    $router->post('user', 'AuthController@register');
    // need authentication
    $router->group(['middleware' => 'apiauth'], function ($router) {
        $router->put('user/{id}', 'AuthController@update');
        $router->get('gift/{code}', 'SystemController@activeGiftCode');
    });
});
