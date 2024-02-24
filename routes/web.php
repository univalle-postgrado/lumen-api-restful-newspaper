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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('login', 'AuthController@login');
        $router->get('me', 'AuthController@me');
        $router->post('refresh', 'AuthController@refresh');
        $router->post('logout', 'AuthController@logout');
    });

    $router->group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () use ($router) {
        $router->get('/categories', ['uses' => 'CategoryController@index']);
        $router->get('/categories/{id}', ['uses' => 'CategoryController@read']);
        $router->post('/categories', ['uses' => 'CategoryController@create']);
        $router->put('/categories/{id}', ['uses' => 'CategoryController@update']);
        $router->patch('/categories/{id}', ['uses' => 'CategoryController@patch']);
        $router->delete('/categories/{id}', ['uses' => 'CategoryController@delete']);

        $router->get('/contents', ['uses' => 'ContentController@index']);
        $router->get('/contents/{id}', ['uses' => 'ContentController@read']);
        $router->post('/contents', ['uses' => 'ContentController@create']);
        $router->put('/contents/{id}', ['uses' => 'ContentController@update']);
        $router->patch('/contents/{id}', ['uses' => 'ContentController@patch']);
        $router->delete('/contents/{id}', ['uses' => 'ContentController@delete']);
        $router->get('/contents/{id}/tags', ['uses' => 'ContentController@tags']);

        $router->get('/tags', ['uses' => 'TagController@index']);
        $router->get('/tags/{id}', ['uses' => 'TagController@read']);
        $router->post('/tags', ['uses' => 'TagController@create']);
        $router->put('/tags/{id}', ['uses' => 'TagController@update']);
        $router->patch('/tags/{id}', ['uses' => 'TagController@patch']);
        $router->delete('/tags/{id}', ['uses' => 'TagController@delete']);
    });


    $router->group(['prefix' => 'v2'], function () use ($router) {
        $router->get('/categories', ['uses' => 'CategoryController@indexV2']);
    });
});