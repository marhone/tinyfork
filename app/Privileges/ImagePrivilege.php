<?php
/**
 * ImagePrivilege, 访问权限认证
 * User: marhone
 * Date: 2019/1/8
 * Time: 15:06
 */

namespace App\Privileges;


use Tinyfork\Http\Request;

class ImagePrivilege implements PrivilegeInterface
{

    public function check(Request $request)
    {
        $uri = $request->getPathInfo();

        // 这里假设用户没有权限访问
        if ($uri === '/admin/1096/images') {
            if (true /* not herself */) {
                return PrivilegeInterface::ACCESS_DENIED;
            }
        }

        return PrivilegeInterface::ACCESS_ABSTAIN;
    }
}