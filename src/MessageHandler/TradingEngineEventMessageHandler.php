<?php

namespace Blazar\TradingEngine\MessageHandler;

use Blazar\TradingEngine\Message\TradingEngineEventMessage;
use Blazar\TradingEngine\Model\TradingEngineEventHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class TradingEngineEventMessageHandler implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @param iterable<TradingEngineEventHandlerInterface> $handlers
     */
    public function __construct(
        private iterable $handlers
    )
    {
    }

    #[NoReturn]
    public function __invoke(TradingEngineEventMessage $message): void
    {
        $this->logger->debug('Received message', ['message' => $message]);

        foreach ($this->handlers as $handler) {
            if ($handler->supports($message)) {
                $this->logger->debug('Handler supported: '. get_class($handler));
                $handler->handle($message);
            }
        }

        if (count($this->handlers) === 0) {
            $this->logger->warning('No trading engine event handlers found.');
        }
    }
}
