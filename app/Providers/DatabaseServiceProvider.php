<?php
/**
 * Database Service Provider
 * User: marhone
 * Date: 2019/1/16
 * Time: 16:23
 */

namespace App\Providers;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\DependencyInjection\Container;
use Tinyfork\Provider\ServiceProviderInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{

    public function register(Container $container)
    {
        $projectDir = $container->getParameter('kernel.project_dir');

        // Doctrine Entity Manager
        $debug = true;
        $config = Setup::createYAMLMetadataConfiguration([$projectDir . '/config/doctrine'], $debug);

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => $projectDir . '/database/db.sqlite'
        ];

        $entityManager = EntityManager::create($conn, $config);

        $databaseOrm = $container->getParameter('database-orm');
        $container->set($databaseOrm, $entityManager);
    }
}