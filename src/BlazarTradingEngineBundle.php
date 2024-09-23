<?php

namespace Blazar\TradingEngine;

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
                ->scalarNode('ca_cert')->defaultNull()->end()
            ->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->parameters()->set('blazar.trading_engine.project', $config['project']);
        $container->parameters()->set('blazar.trading_engine.ca_cert', $config['ca_cert']);
        $container->import('../config/services.yaml');
    }
}