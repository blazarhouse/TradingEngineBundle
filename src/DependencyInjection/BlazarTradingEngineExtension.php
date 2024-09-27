<?php

namespace Blazar\TradingEngine\DependencyInjection;

use Blazar\TradingEngine\Model\TradingAccountInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class BlazarTradingEngineExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->registerForAutoconfiguration(TradingAccountInterface::class)
            ->addTag('blazar.trading_engine.trading_event_handler')
        ;
    }
}