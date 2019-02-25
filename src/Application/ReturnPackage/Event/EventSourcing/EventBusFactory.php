<?php

namespace RGA\Application\ReturnPackage\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\ReturnPackage\Event;
use RGA\Domain\Model\ReturnPackage\Projection;
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
		/** @var Projection\ReturnPackageProjectorInterface $returnPackageProjector */
		$returnPackageProjector = $container->get(Projection\ReturnPackageProjectorInterface::class);
		
		$this->eventRouter
			->route(Event\NewReturnPackageCreated::class)
			->to([$returnPackageProjector, 'onNewReturnPackageCreated']);
		
		$this->eventRouter
			->route(Event\ReturnPackageSet::class)
			->to([$returnPackageProjector, 'onReturnPackageSet']);
		
		$this->attachRoutesToEventBus($eventBus);
	}
}