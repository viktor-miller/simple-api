<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'v1', 'namespace' => 'V1'], function($router) {
    $router->get('/postingStats', ['as' => 'posting-stats', 'uses' => 'PostController@stats']);
});
