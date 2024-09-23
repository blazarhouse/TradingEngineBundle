<?php

namespace Blazar\TradingEngine\Message;


use Blazar\TradingEngine\Model\TradeOrder;

final class TradingEngineMessage
{
    public const EVENT_WATCH = 'watch';
    public const EVENT_DELETE = 'delete';
    public const FETCH_BALANCE = 'fetch_balance';
    public const FETCH_POSITIONS = 'fetch_positions';
    public const FETCH_TRANSFERS = 'fetch_transfers';
    public const TRADING = 'trading';

    public string $event;
    public string $project;
    public string $projectId;
    public ?string $exchange = null;
    public ?string $apiKey = null;
    public ?string $secret = null;
    public ?string $password = null;
    public string $type = 'future';
    public bool $watchBalance = false;
    public bool $watchTrades = false;
    public bool $watchPositions = false;
    public array $metadata = [];

    public ?TradeOrder $order = null;
}
