<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/categories'], function (Router $router) {
   
      //Route create
        $router->post('/', [
          'as' => 'api.itest.categories.create',
          'uses' => 'CategoryApiController@create',
          'middleware' => ['auth:api']
        ]);
      
        //Route index
        $router->get('/', [
          'as' => 'api.itest.categories.get.items.by',
          'uses' => 'CategoryApiController@index',
          //'middleware' => ['auth:api']
        ]);
      
        //Route show
        $router->get('/{criteria}', [
          'as' => 'api.itest.categories.get.item',
          'uses' => 'CategoryApiController@show',
          //'middleware' => ['auth:api']
        ]);
        
          //Route update
        $router->put('/{criteria}', [
          'as' => 'api.itest.categories.update',
          'uses' => 'CategoryApiController@update',
          'middleware' => ['auth:api']
        ]);
        
        //Route delete
        $router->delete('/{criteria}', [
          'as' => 'api.itest.categories.delete',
          'uses' => 'CategoryApiController@delete',
          'middleware' => ['auth:api']
        ]);
});
