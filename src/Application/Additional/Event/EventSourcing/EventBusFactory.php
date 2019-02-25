<?php

namespace RGA\Application\Additional\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Additional\Event;
use RGA\Domain\Model\Additional\Projection;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

class EventBusFactory
	extends EventSourcing\AbstractEventBusFactory
{
	/**
	 * @param EventSourcing\EventBus $eventBus
	 * @param ContainerInterface $container
	 */
	public function populate(EventSourcing\EventBus $eventBus, ContainerInterface $container): void
	{
		/** @var Projection\AdditionalProjectorInterface $additionalProjector */
		$additionalProjector = $container->get(Projection\AdditionalProjectorInterface::class);
		
		$this->eventRouter
			->route(Event\NewAdditionalCreated::class)
			->to([$additionalProjector, 'onNewAdditionalCreated']);
		
		
		$this->attachRoutesToEventBus($eventBus);
	}
}