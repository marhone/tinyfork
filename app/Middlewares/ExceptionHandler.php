<?php
/**
 * Exception Handler middleware
 * User: marhone
 * Date: 2019/1/10
 * Time: 13:30
 */

namespace App\Middlewares;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class ExceptionHandler implements MiddlewareInterface
{

    public function __invoke(Request $request, Response $response, callable $next)
    {
        try {
            $response = $next($request, $response);
        } catch (\Throwable $exception) {
            dump($exception);
            $response = new Response('opps! <br><hr>' . $exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}