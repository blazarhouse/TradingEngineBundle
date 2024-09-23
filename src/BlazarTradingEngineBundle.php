<?php

namespace Blazar\TradingEngine;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BlazarTradingEngineBundle extends Bundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('project')->end()
            ->end()
        ;
    }
}