<?php
/**
 * Register services
 * User: marhone
 * Date: 2019/1/16
 * Time: 16:44
 */

namespace App\Providers;


use Symfony\Component\DependencyInjection\Container;
use Tinyfork\Provider\ServiceProviderInterface;

class ServiceProviderRegister implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        // 在这里添加用户所需要的服务
        $providers = [
            new DatabaseServiceProvider(),
            new ViewServiceProvider()
        ];

        foreach ($providers as $provider) {
            $provider->register($container);
        }
    }
}