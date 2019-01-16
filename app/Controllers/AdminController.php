<?php
/**
 * AdminController
 * User: marhone
 * Date: 2019/1/8
 * Time: 15:25
 */

namespace App\Controllers;


use App\Privileges\TokenStorage;
use Tinyfork\Http\Response;

class AdminController
{
    public function me()
    {
        $tokenStorage = app(TokenStorage::class);
        return new Response(sprintf('Hello %s (admin)', $tokenStorage->getLastToken()['username']));
    }

    public function mikuru()
    {
        return response()->json([
            'images' => 'booyah'
        ]);
    }
}