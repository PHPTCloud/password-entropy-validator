<?php

declare(strict_types=1);

namespace PasswordEntropyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author tcloud.ax <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class PasswordEntropyBundleExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}