<?php

namespace Blazar\TradingEngine\Serializer;

use Blazar\TradingEngine\Message\TradingEngineEventMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class TradingEngineEventSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        $headers = $encodedEnvelope['headers'];
        $message = new TradingEngineEventMessage($body);

        $stamps = [];
        if (isset($headers['stamps'])) {
            $stamps = unserialize($headers['stamps']);
        }

        return new Envelope($message, $stamps);
    }
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $allStamps = [];
        foreach ($envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }

        return [
            'body' => json_encode($message),
            'headers' => [
                'stamps' => serialize($allStamps)
            ],
        ];
    }
}