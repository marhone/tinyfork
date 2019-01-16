<?php
/**
 * define the routes.
 * User: marhone
 * Date: 2019/1/15
 * Time: 15:37
 */

use App\Middlewares\APIGuard;
use App\Middlewares\Authentication;
use App\Middlewares\PrivilegeChecker;
use App\Middlewares\Throttle;
use Tinyfork\Http\Request;

$router = new \Tinyfork\Router\Router();

$router->get('/', 'App\Controllers\IndexController@index');
$router->get('/foo', 'App\Controllers\FooController@run');

$router->get('/{id}/posts/show', function ($id) {
    dd(['id/posts/show' => $id]);
});
$router->get('/posts/{id}/show', function ($id) {
    dd(['id/show' => $id]);
});
$router->get('/posts/show/{id}', function ($id) {
    dd(['show/id' => $id]);
});

// 用户认证, 鉴权
$router->group([
    'prefix' => '/admin',
    'middleware' => [
        app(Authentication::class),
        app(PrivilegeChecker::class)
    ]
], function ($router) {
    $router->get('me', 'App\Controllers\AdminController@me');
    $router->get('1096/images', 'App\Controllers\AdminController@mikuru');
});

//$router->get('/api/products', 'App\Controllers\api\ProductsController@list');
//$router->get('/api/products/{id}', 'App\Controllers\api\ProductsController@show');
//$router->post('/api/products', 'App\Controllers\api\ProductsController@store');

$router->group([
    'prefix' => '/api',
    'namespace' => 'App\Controllers\api'
], function ($router) {
    $router->get('products', 'ProductsController@list');
    $router->get('products/{id}', 'ProductsController@show');
    $router->post('products', 'ProductsController@store');
    $router->put('products/{id}', 'ProductsController@update');
    $router->delete('products/{id}', 'ProductsController@delete');
});

$router->get('/hello/{name}', function (Request $request, $name) {
    $token = $request->get('token', 'no token');
    return "Hello {$name}! token: {$token}";
});

$router->group([
    'middleware' => [
        app(APIGuard::class),
        app(Throttle::class)
    ],
    'prefix' => '/api',
    'namespace' => 'App\Controllers\api'
], function ($router) {
    $router->get('users/me', 'UsersController@me');
    $router->post('users', 'UsersController@store');
    $router->delete('users', 'UsersController@store');

    $router->group([], function ($router) {
        $router->get('hello/{name}', function (Request $request, $name) {
            $token = $request->get('token', 'no token');
            return "Hello {$name}! token: {$token}";
        });
    });
});

return $router;