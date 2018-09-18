<?php

namespace RGA\Application\SegregationSourcing\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\SegregationSourcing\Event\Plugin\EventRouter;
use RGA\Domain\Model\Attachment;
use RGA\Domain\Model\Behaviour;
use RGA\Domain\Model\Dictionary;
use RGA\Domain\Model\ReturnPackage;
use RGA\Domain\Model\Rga;
use RGA\Domain\Model\State;
use RGA\Domain\Model\Transport;

class EventBusFactory
{
	/**
	 * @param ContainerInterface $container
	 * @return EventBus
	 */
	public static function get(ContainerInterface $container): EventBus
	{
		$router = new EventRouter();
		
		// Attachment
		$router
			->route(Attachment\Event\NewAttachmentCreated::class)
			->to([$container->get(Attachment\Projection\AttachmentProjectorInterface::class), 'onNewAttachmentCreated']);
		
		$router
			->route(Attachment\Event\ExistingAttachmentRemoved::class)
			->to([$container->get(Attachment\Projection\AttachmentProjectorInterface::class), 'onExistingAttachmentRemoved']);
		
		// Behaviour
		$router
			->route(Behaviour\Event\NewBehaviourCreated::class)
			->to([$container->get(Behaviour\Projection\BehaviourProjectorInterface::class), 'onNewBehaviourCreated']);
		
		$router
			->route(Behaviour\Event\ExistingBehaviourChanged::class)
			->to([$container->get(Behaviour\Projection\BehaviourProjectorInterface::class), 'onExistingBehaviourChanged']);
		
		// Dictionary
		$router
			->route(Dictionary\Event\NewDictionaryCreated::class)
			->to([$container->get(Dictionary\Projection\DictionaryProjectorInterface::class), 'onNewDictionaryCreated']);
		
		$router
			->route(Dictionary\Event\ExistingDictionaryChanged::class)
			->to([$container->get(Dictionary\Projection\DictionaryProjectorInterface::class), 'onExistingDictionaryChanged']);
		
		$router
			->route(Dictionary\Event\ExistingDictionaryRemoved::class)
			->to([$container->get(Dictionary\Projection\DictionaryProjectorInterface::class), 'onExistingDictionaryRemoved']);
		
		// Rga
		$router
			->route(Rga\Event\ApplicantRgaChanged::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onApplicantRgaChanged']);
		
		$router
			->route(Rga\Event\ExistingRgaRemoved::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onExistingRgaRemoved']);
		
		$router
			->route(Rga\Event\FlagsRgaChanged::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onFlagsRgaChanged']);
		
		$router
			->route(Rga\Event\NoteRgaChanged::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onNoteRgaChanged']);
		
		$router
			->route(Rga\Event\NewRgaCreated::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onNewRgaCreated']);
		
		$router
			->route(Rga\Event\PackageRgaSet::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onPackageRgaSet']);
		
		$router
			->route(Rga\Event\StateRgaChanged::class)
			->to([$container->get(Rga\Projection\RgaProjectorInterface::class), 'onStateRgaChanged']);
		
		// State
		$router
			->route(State\Event\NewStateCreated::class)
			->to([$container->get(State\Projection\StateProjectorInterface::class), 'onNewStateCreated']);
		
		$router
			->route(State\Event\ExistingStateChanged::class)
			->to([$container->get(State\Projection\StateProjectorInterface::class), 'onExistingStateChanged']);
		
		$router
			->route(State\Event\ExistingStateRemoved::class)
			->to([$container->get(State\Projection\StateProjectorInterface::class), 'onExistingStateRemoved']);
		
		// Transport
		$router
			->route(Transport\Event\NewTransportCreated::class)
			->to([$container->get(Transport\Projection\TransportProjectorInterface::class), 'onNewTransportCreated']);
		
		$router
			->route(Transport\Event\ExistingTransportChanged::class)
			->to([$container->get(Transport\Projection\TransportProjectorInterface::class), 'onExistingTransportChanged']);
		
		$router
			->route(Transport\Event\ExistingTransportRemoved::class)
			->to([$container->get(Transport\Projection\TransportProjectorInterface::class), 'onExistingTransportRemoved']);
		
		// ReturnPackage
		$router
			->route(ReturnPackage\Event\NewReturnPackageCreated::class)
			->to([$container->get(ReturnPackage\Projection\ReturnPackageProjectorInterface::class), 'onNewReturnPackageCreated']);
		
		$router
			->route(ReturnPackage\Event\ReturnPackageSet::class)
			->to([$container->get(ReturnPackage\Projection\ReturnPackageProjectorInterface::class), 'onReturnPackageSet']);
		
		$bus = new EventBus();
		$bus->setRouter($router);
		
		return $bus;
	}
}