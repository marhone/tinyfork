<?php
/**
 * 获取 Doctrine Manager 的实例对象
 * User: marhone
 * Date: 2019/1/11
 * Time: 11:12
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
// replace with mechanism to retrieve EntityManager in your app
$entityManager = require_once(__DIR__ . '/../console/index.php');

return ConsoleRunner::createHelperSet($entityManager);