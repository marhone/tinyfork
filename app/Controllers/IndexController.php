<?php
/**
 * Index controller
 * User: marhone
 * Date: 2019/1/8
 * Time: 11:17
 */

namespace App\Controllers;


use Tinyfork\Http\Request;
use Tinyfork\Http\Response;

class IndexController
{
    public function index(Request $request)
    {
        return view('index\index');
    }
}