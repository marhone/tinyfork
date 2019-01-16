<?php
/**
 * Throttle middle
 * User: marhone
 * Date: 2019/1/15
 * Time: 13:28
 */

namespace App\Middlewares;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class Throttle implements MiddlewareInterface
{

    public function __invoke(Request $request, Response $response, callable $next)
    {
        dump('=============================== throttle start');
        $response = $next($request, $response, $next);
        dump('=============================== throttle end');

        return $response;
    }
}