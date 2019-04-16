<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\Plugin;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\EventRouterInterface;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;

class EventRouter implements EventRouterInterface
{
    /** @var string */
    private $tmpEventName;
    
    /** @var array */
    private $listenerMap = [];
    
    /**
     * @param string $messageName
     * @return EventRouterInterface
     */
    public function route($messageName): EventRouterInterface
    {
        if (true === empty($messageName)) {
            throw new \InvalidArgumentException('Event name cannot be empty');
        }
        
        $this->tmpEventName = $messageName;
        
        return $this;
    }
    
    /**
     * @param callable $listener
     * @return EventRouterInterface
     */
    public function to($listener): EventRouterInterface
    {
        if (true === empty($this->tmpEventName)) {
            throw new \RuntimeException('Please provide event name first with route method');
        }
        
        if (false === is_callable($listener)) {
            throw new \RuntimeException(sprintf(
                'Invalid listener provided. Expected type is callable but type of %s given.',
                gettype($listener)
            ));
        }
        
        $this->listenerMap[$this->tmpEventName][] = $listener;
        
        return $this;
    }
    
    /**
     * @param callable $listener
     * @return EventRouterInterface
     */
    public function andTo($listener): EventRouterInterface
    {
        $this->to($listener);
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->listenerMap;
    }
    
    /**
     * @param EventRouterInterface $router
     */
    public function merge(EventRouterInterface $router): void
    {
        $this->listenerMap = \array_merge($this->listenerMap, $router->getMap());
    }
    
    /**
     * @param string $messageName
     * @return MessageHandlerInterface[]
     */
    public function map($messageName): array
    {
        return $this->listenerMap[$messageName];
    }
    
    /**
     * @param MessageBusInterface $bus
     */
    public function attachToMessageBus(MessageBusInterface $bus): void
    {
        $bus->setRouter($this);
    }
}
