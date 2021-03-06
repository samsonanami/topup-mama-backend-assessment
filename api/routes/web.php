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
    /**
     * Book APIs
     */
    $router->get('/book', 'BookController@index');
    $router->post('/book', 'BookController@store');
    $router->get('/book/{id}', 'BookController@show');
    $router->put('/book/{id}', 'BookController@update');
    $router->delete('/book/{id}', 'BookController@destroy');
    /**
     * Character APIs
     */
    $router->get('/character', 'CharacterController@index');
    $router->post('/character', 'CharacterController@store');
    $router->get('/character/{id}', 'CharacterController@show');
    $router->put('/character/{id}', 'CharacterController@update');
    $router->delete('/character/{id}', 'CharacterController@destroy');
    /**
     * Comment APIs
     */
    $router->get('/comment', 'CommentController@index');
    $router->post('/comment', 'CommentController@store');
    $router->get('/comment/{id}', 'CommentController@show');
    $router->put('/comment/{id}', 'CommentController@update');
    $router->delete('/comment/{id}', 'CommentController@destroy');
});
