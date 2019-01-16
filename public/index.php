<?php
/**
 * 入口文件
 * User: marhone
 * Date: 2019/1/8
 * Time: 11:04
 */

use Tinyfork\Http\Request;
use Tinyfork\Kernel\HttpKernel;

// Composer 自动加载
require __DIR__ . '/../vendor/autoload.php';

// 从全局变量中创建 Request
$request = Request::createFromGlobals();
//$response = (HttpKernel::newInstance('prod', false))->handle($request);
$response = (HttpKernel::newInstance(dirname(__DIR__), 'dev', true))->handle($request);

$response->send();