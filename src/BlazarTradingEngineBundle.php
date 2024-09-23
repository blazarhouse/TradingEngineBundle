<?php

namespace Blazar\TradingEngine;

use Blazar\TradingEngine\Service\TradingEngineClient;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class BlazarTradingEngineBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('project')->end()
            ->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');
        $container->services()->get(TradingEngineClient::class)->arg(0, $config['project']);

        // To define parameters
//        $container->parameters()->set('acme_hello.phrase', $config['phrase']);
    }
}