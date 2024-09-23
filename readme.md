## Installation

### config/package/trading_engine.yaml

Full configuration 

```yaml
blazar_trading_engine:
    project: test
    ca_cert: '%kernel.project_dir%/data/AmazonRootCA1.pem'

framework:
    messenger:
        serializer:
            default_serializer: messenger.transport.symfony_serializer
            symfony_serializer:
            format: json
            context: { }
        failure_transport: failed
        
        transports:
          websockets: '%env(MESSENGER_TRANSPORT_WEBSOCKETS_DSN)%'
          tradingEngineEvents:
            dsn: '%env(MESSENGER_TRANSPORT_TRADING_ENGINE_EVENTS_DSN)%'
            serializer: Blazar\TradingEngine\Serializer\TradingEngineEventSerializer
    
        default_bus: messenger.bus.default
    
        buses:
          messenger.bus.default: [ ]
    
        routing:
          Blazar\TradingEngine\Message\TradingEngineMessage: websockets
          Blazar\TradingEngine\Message\TradingEngineEventMessage: tradingEngineEvents
``
