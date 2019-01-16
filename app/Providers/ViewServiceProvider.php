<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 17:17
 */

namespace App\Providers;


use Symfony\Component\DependencyInjection\Container;
use Tinyfork\Provider\ServiceProviderInterface;

class ViewServiceProvider implements ServiceProviderInterface
{

    public function register(Container $container)
    {
        $environment = $container->getParameter('kernel.environment');
        $projectDir = $container->getParameter('kernel.project_dir');
        $debug = $container->getParameter('kernel.debug');

        $loader = new \Twig_Loader_Filesystem($projectDir . '/views');
        $options = $debug
            ? []
            : [
                'cache' => $projectDir . '/storage/forks/cache/' . $environment . '/views'
            ];
        $twig = new \Twig_Environment($loader, $options);

        $engineName = $container->getParameter('view-engine');
        $container->set($engineName, $twig);
    }
}