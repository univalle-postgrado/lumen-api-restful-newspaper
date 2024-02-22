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
    $router->group(['prefix' => 'v1'], function () use ($router) {
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
    });


    $router->group(['prefix' => 'v2'], function () use ($router) {
        $router->get('/categories', ['uses' => 'CategoryController@indexV2']);
    });
});