<?php
/**
 * Foo controller
 * User: marhone
 * Date: 2019/1/8
 * Time: 11:12
 */

namespace App\Controllers;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;

class FooController
{
    public function run(Request $request)
    {
        return new Response('Foo page');
    }
}