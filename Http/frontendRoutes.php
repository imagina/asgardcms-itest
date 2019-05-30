<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/test'], function (Router $router) {
    $router->get('/', [
        'as' => 'itest.index',
        'uses' => 'PublicController@index',
    ]);
    $router->group(['prefix' => '{slug}'], function (Router $router) {
        $router->get('/', [
            'as' => 'itest.show',
            'uses' => 'PublicController@show',
        ]);
        $router->post('test/store', [
            'as' => 'itest.test.store',
            'uses' => 'PublicController@store',
            //'middleware' => 'can:itest.tests.edit'
        ]);
        $router->get('answer', [
            'as' => 'itest.answer',
            'uses' => 'PublicController@answer',
        ]);
    });




});
