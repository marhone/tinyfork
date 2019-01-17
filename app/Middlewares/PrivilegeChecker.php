<?php
/**
 * PrivilegeChecker middleware
 * User: marhone
 * Date: 2019/1/8
 * Time: 15:42
 */

namespace App\Middlewares;


use App\Privileges\PrivilegeInterface;
use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class PrivilegeChecker implements MiddlewareInterface
{
    /**
     * @var PrivilegeInterface[]
     */
    private $voters;

    /**
     * PrivilegeChecker constructor.
     * @param array $voters
     */
    public function __construct(array $voters)
    {
        $this->voters = $voters;
    }


    public function __invoke(Request $request, Response $response, callable $next)
    {
        $deny = 0;
        foreach ($this->voters as $voter) {
            $result = $voter->check($request);
            switch ($result) {
                case PrivilegeInterface::ACCESS_GRANTED:
                    return $next($request, $response);

                case PrivilegeInterface::ACCESS_DENIED:
                    ++$deny;
                    break;

                default:
                    break;
            }
        }

        if ($deny > 0) {
            return new Response('Forbidden', Response::HTTP_FORBIDDEN);
        }

        return $next($request, $response);
    }
}