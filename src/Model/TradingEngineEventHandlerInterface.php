<?php

namespace Blazar\TradingEngine\Model;

use Blazar\TradingEngine\Message\TradingEngineEventMessage;

interface TradingEngineEventHandlerInterface
{
    public function supports(TradingEngineEventMessage $message): bool;
    public function handle(TradingEngineEventMessage $message): void;
}