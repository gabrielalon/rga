<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

use Psr\Container\ContainerInterface;

class EventBusFactoryCollection
{
    /** @var AbstractEventBusFactory[] */
    private $factories = [];
    
    /**
     * @param AbstractEventBusFactory $eventBusFactory
     */
    public function register(AbstractEventBusFactory $eventBusFactory): void
    {
        $this->factories[] = $eventBusFactory;
    }
    
    /**
     * @param EventBus $eventBus
     * @param ContainerInterface $container
     */
    public function populate(EventBus $eventBus, ContainerInterface $container): void
    {
        foreach ($this->factories as $factory) {
            $factory->populate($eventBus, $container);
        }
    }
}
