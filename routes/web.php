<?php

$router->get('/api/users', 'UserController@getAll');
$router->group(['prefix' => "/api/user"], function() use ($router){
    $router->get('/{id}', 'UserController@getOne');
    $router->post('/', 'UserController@new');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@delete');
});
