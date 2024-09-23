<?php

namespace Blazar\TradingEngine\Message;

final class TradingEngineEventMessage
{
    public const TYPE_BALANCE = 'balance';
    public const TYPE_POSITIONS = 'positions';
    public const TYPE_TRANSFERS = 'transfers';
    public const TYPE_TRADING = 'trading';
    public const AUTHENTICATION_ERROR = 'authentication_error';
    public const PERMISSION_DENIED = 'permission_denied';

    public string $event;
    public string $project;
    public string $projectId;
    public string $exchange;
    public string $type;
    public array $data;
    public array $metadata;

    public function __construct(?string $encodedData = null)
    {
        if ($encodedData) {
            $data = json_decode($encodedData, true);
            $this->event = $data['event'];
            $this->project = $data['project'];
            $this->projectId = $data['projectId'];
            $this->exchange = $data['exchange'];
            $this->type = $data['type'];
            $this->data = $data['data'];
            $this->metadata = $data['metadata'] ?? [];
        }
    }
}
