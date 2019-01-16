<?php
/**
 * UsersController
 * User: marhone
 * Date: 2019/1/15
 * Time: 11:32
 */

namespace App\Controllers\api;


class UsersController
{
    public function me()
    {
        return [
            'name' => 'rick',
            'dimension' => 'c-137'
        ];
    }
}