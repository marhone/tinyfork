<?php
/**
 * AdminPrivilege, 登录用户身份认证
 * User: marhone
 * Date: 2019/1/8
 * Time: 15:01
 */

namespace App\Privileges;


use Tinyfork\Http\Request;
use Tinyfork\Privilege\PrivilegeInterface;

class AdminPrivilege implements PrivilegeInterface
{

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * AdminPrivilege constructor.
     * @param $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function check(Request $request)
    {
        $uri = $request->getPathInfo();

        $token = $this->tokenStorage->getLastToken();
        if ($token['username'] !== 'marhone' && $uri === '/admin/login') {
            return PrivilegeInterface::ACCESS_DENIED;
        }

        return PrivilegeInterface::ACCESS_ABSTAIN;
    }
}