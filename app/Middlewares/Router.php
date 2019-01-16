<?php
/**
 * Router middleware
 * User: marhone
 * Date: 2019/1/8
 * Time: 12:33
 */

namespace App\Middlewares;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class Router implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        // TODO: REF THIS LATER.
        $router = require_once app('kernel.project_dir') . '/routes/routes.php';

        $response = $router->dispatch($request, $response);

        return $next($request, $response);
    }
}