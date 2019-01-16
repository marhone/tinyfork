<?php
/**
 * Auth middleware
 * User: marhone
 * Date: 2019/1/8
 * Time: 14:48
 */

namespace App\Middlewares;

use App\Privileges\TokenStorage;
use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class Authentication implements MiddlewareInterface
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * Authentication constructor.
     * @param $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    public function __invoke(Request $request, Response $response, callable $next)
    {
        $uri = $request->getPathInfo();

        $auth = $request->server->get('PHP_AUTH_USER') ?? '';
        $pass = $request->server->get('PHP_AUTH_PW') ?? '';

        if ($uri !== '/admin/me') {
            return $next($request, $response);
        }

        if (empty($auth)) {
            return new Response('authenticate need', Response::HTTP_UNAUTHORIZED, ['WWW-Authenticate' => 'Basic realm=admin login']);
        }

        // TODO: 登录认证检查
        if ($auth !== 'marhone' || $pass !== '13') {
            return new Response('authentication failed', Response::HTTP_UNAUTHORIZED, ['WWW-Authenticate' => 'Basic realm="admin login"']);
        }

        $token = sha1(random_bytes(100));
        $this->tokenStorage->addToken([
            'token' => $token,
            'username' => $auth
        ]);

        return $next($request, $response);
    }
}