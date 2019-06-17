<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'test'], function (Router $router) {
    //======  CATEGORIES
    require('ApiRoutes/categoriesRoutes.php');
});
