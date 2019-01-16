<?php
/**
 * 提供 Entity Manager 给 vendor/bin/doctrine 主命令
 * User: marhone
 * Date: 2019/1/11
 * Time: 11:15
 */

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';

$debug = true;
$config = Setup::createYAMLMetadataConfiguration([dirname(__DIR__) . '/config/doctrine'], $debug);

$conn = [
    'driver' => 'pdo_sqlite',
    'path' => dirname(__DIR__) . '/database/db.sqlite'
];

return EntityManager::create($conn, $config);