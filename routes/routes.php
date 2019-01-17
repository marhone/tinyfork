<?php
/**
 * define the routes.
 * User: marhone
 * Date: 2019/1/15
 * Time: 15:37
 */

use Tinyfork\Http\Request;

$router = new \Tinyfork\Router\Router();

$router->get('/', 'App\Controllers\IndexController@index');

$router->get('/hello/{name}', function(Request $request, $name) {
    return response("Hello ${name}!");
});

return $router;