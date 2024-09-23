<?php

namespace Blazar\TradingEngine\Model;

class TradeOrder
{
    public const TYPE_MARKET = 'market';

    public const SIDE_BUY = 'buy';
    public const SIDE_SELL = 'sell';

    private string $symbolBase;
    private string $symbolQuote;
    private ?string $symbolSettle = 'USDT';
    public function __construct(
        private readonly string $symbol,
        private readonly int $leverage,
        private readonly string $type,
        private readonly string $side,
        private readonly float $amount,
        private readonly ?float $price = null,
    ) {
        preg_match('#([a-z1-9]+)/([a-z1-9]+):?([a-z1-9]+)?#i', $this->symbol, $symbolParts);

        if (isset($symbolParts[1])) { $this->symbolBase = $symbolParts[1]; }
        if (isset($symbolParts[2])) { $this->symbolQuote = $symbolParts[2]; }
        if (isset($symbolParts[3])) { $this->symbolSettle = $symbolParts[3]; }
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getSymbolBase(): string
    {
        return $this->symbolBase;
    }

    public function getSymbolQuote(): string
    {
        return $this->symbolQuote;
    }

    public function getSymbolSettle(): ?string
    {
        return $this->symbolSettle;
    }

    public function getLeverage(): int
    {
        return $this->leverage;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}