<?php

namespace RGA\Application\Attachment\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Attachment\Event;
use RGA\Domain\Model\Attachment\Projection;
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
		/** @var Projection\AttachmentProjectorInterface $attachmentProjector */
		$attachmentProjector = $container->get(Projection\AttachmentProjectorInterface::class);
		
		$this->eventRouter
			->route(Event\NewAttachmentCreated::class)
			->to([$attachmentProjector, 'onNewAttachmentCreated']);
		
		$this->eventRouter
			->route(Event\ExistingAttachmentRemoved::class)
			->to([$attachmentProjector, 'onExistingAttachmentRemoved']);
		
		
		$this->attachRoutesToEventBus($eventBus);
	}
}