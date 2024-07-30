<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->get('/test', function () {
    return response()->json(['message' => 'Test endpoint is working!']);
});

$router->group(['middleware' => 'jwt.auth'], function () use ($router) {
    $router->post('posts', 'PostController@create');
    $router->put('posts/{id}', 'UserController@updatePost');
    $router->delete('posts/{id}', 'UserController@deletePost');
    $router->post('replies', 'ReplyController@create');
    $router->post('user-details', 'UserDetailController@store');
});

$router->group(['middleware' => 'check.admin'], function () use ($router) {
    $router->delete('admin/posts/{id}', 'AdminController@deletePost');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
});
