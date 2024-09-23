<?php

namespace Blazar\TradingEngine\Model;

interface TradingAccountInterface
{
    public function getId();
    public function getExchange();
    public function getType();
    public function getApiKey();
    public function getApiSecret();
    public function getApiPassword();
}