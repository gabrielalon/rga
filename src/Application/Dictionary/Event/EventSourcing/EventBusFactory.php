<?php

namespace RGA\Application\Dictionary\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Dictionary\Event;
use RGA\Domain\Model\Dictionary\Projection;
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
		/** @var Projection\DictionaryProjectorInterface $dictionaryProjector */
		$dictionaryProjector = $container->get(Projection\DictionaryProjectorInterface::class);
		
		$this->eventRouter
			->route(Event\NewDictionaryCreated::class)
			->to([$dictionaryProjector, 'onNewDictionaryCreated']);
		
		$this->eventRouter
			->route(Event\ExistingDictionaryChanged::class)
			->to([$dictionaryProjector, 'onExistingDictionaryChanged']);
		
		$this->eventRouter
			->route(Event\ExistingDictionaryRemoved::class)
			->to([$dictionaryProjector, 'onExistingDictionaryRemoved']);
		
		$this->attachRoutesToEventBus($eventBus);
	}
}