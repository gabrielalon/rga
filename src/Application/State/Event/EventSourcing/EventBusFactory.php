<?php

namespace RGA\Application\State\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\State\Event;
use RGA\Domain\Model\State\Projection;
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
		/** @var Projection\StateProjectorInterface $stateProjector */
		$stateProjector = $container->get(Projection\StateProjectorInterface::class);
		
		$this->eventRouter
			->route(Event\NewStateCreated::class)
			->to([$stateProjector, 'onNewStateCreated']);
		
		$this->eventRouter
			->route(Event\ExistingStateChanged::class)
			->to([$stateProjector, 'onExistingStateChanged']);
		
		$this->eventRouter
			->route(Event\ExistingStateRemoved::class)
			->to([$stateProjector, 'onExistingStateRemoved']);
		
		$this->attachRoutesToEventBus($eventBus);
	}
}