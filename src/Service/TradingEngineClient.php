<?php

namespace Blazar\TradingEngine\Service;

use Blazar\TradingEngine\Message\TradingEngineMessage;
use Blazar\TradingEngine\Model\TradeOrder;
use Blazar\TradingEngine\Model\TradingAccountInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TradingEngineClient
{
    public function __construct(
        private readonly string $project,
        private readonly MessageBusInterface $bus,
    )
    {
    }

    public function watch(TradingAccountInterface $tradingAccount, bool $watchBalance = false, bool $watchTraders = false, bool $watchPositions = false): void
    {
        $message = $this->buildBaseMessage($tradingAccount, true);
        $message->event = TradingEngineMessage::EVENT_WATCH;
        $message->watchBalance = $watchBalance;
        $message->watchTrades = $watchTraders;
        $message->watchPositions = $watchPositions;

        $this->bus->dispatch($message);
    }

    public function unwatch(TradingAccountInterface $tradingAccount): void
    {
        $message = $this->buildBaseMessage($tradingAccount);
        $message->event = TradingEngineMessage::EVENT_DELETE;

        $this->bus->dispatch($message);
    }

    public function fetchBalance(TradingAccountInterface $tradingAccount): void
    {
        $message = $this->buildBaseMessage($tradingAccount, true);
        $message->event = TradingEngineMessage::FETCH_BALANCE;

        $this->bus->dispatch($message);
    }

    public function fetchPositions(TradingAccountInterface $tradingAccount): void
    {
        $message = $this->buildBaseMessage($tradingAccount, true);
        $message->event = TradingEngineMessage::FETCH_POSITIONS;

        $this->bus->dispatch($message);
    }

    public function fetchTransfers(TradingAccountInterface $tradingAccount): void
    {
        $message = $this->buildBaseMessage($tradingAccount, true);
        $message->event = TradingEngineMessage::FETCH_TRANSFERS;

        $this->bus->dispatch($message);
    }

    public function trade(TradingAccountInterface $tradingAccount, TradeOrder $order, array $metadata = []): void
    {
        $message = $this->buildBaseMessage($tradingAccount, true);
        $message->event = TradingEngineMessage::TRADING;
        $message->metadata = $metadata;
        $message->order = $order;

        $this->bus->dispatch($message);
    }

    private function buildBaseMessage(TradingAccountInterface $tradingAccount, bool $withCredentials = false): TradingEngineMessage
    {
        $message = new TradingEngineMessage();
        $message->project = $this->project;
        $message->projectId = $tradingAccount->getId();
        $message->exchange = $tradingAccount->getExchange();
        $message->type = $tradingAccount->getType();

        if ($withCredentials) {
            $message->apiKey = $tradingAccount->getApiKey();
            $message->secret = $tradingAccount->getApiSecret();
            $message->password = $tradingAccount->getApiPassword();
        }

        return $message;
    }
}