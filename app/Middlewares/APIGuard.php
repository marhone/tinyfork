<?php
/**
 * API Guard
 * User: Administrator
 * Date: 2019/1/15
 * Time: 11:40
 */

namespace App\Middlewares;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class APIGuard implements MiddlewareInterface
{

    public function __invoke(Request $request, Response $response, callable $next)
    {
        dump('------------------------------- guard start');
        $response = $next($request, $response, $next);
        dump('------------------------------- guard end');

        return $response;
    }
}