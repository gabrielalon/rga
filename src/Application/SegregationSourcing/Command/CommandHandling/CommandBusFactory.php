<?php

namespace RGA\Application\SegregationSourcing\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\SegregationSourcing\Command\Plugin\CommandRouter;
use RGA\Application\SegregationSourcing\Event\EventSourcing\EventBusFactory;
use RGA\Domain\Model\Attachment;
use RGA\Domain\Model\Behaviour;
use RGA\Domain\Model\Dictionary;
use RGA\Domain\Model\Rga;
use RGA\Domain\Model\State;
use RGA\Domain\Model\Transport;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\BusBridge\EventPublisher;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\EventStorage;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage;
use RGA\Infrastructure\Source\Warranty\ConfigInterface;

class CommandBusFactory
{
	/**
	 * @param ContainerInterface $container
	 * @return CommandBus
	 */
	public static function get(ContainerInterface $container): CommandBus
	{
		$router = new CommandRouter();
		
		$snapshotStorage = new SnapshotStorage($container->get(SnapshotRepositoryInterface::class));
		$eventStorage = new EventStorage($container->get(EventStreamRepositoryInterface::class));
		
		$eventPublisher = new EventPublisher(EventBusFactory::get($container));
		$eventPublisher->attachToEventStorage($eventStorage);
		
		// Attachment
		$router
			->route(Attachment\Command\CreateAttachment::class)
			->to(new Attachment\Command\CreateAttachmentHandler(
				new Persist\Attachment\AttachmentRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Attachment\Command\RemoveAttachment::class)
			->to(new Attachment\Command\RemoveAttachmentHandler(
				new Persist\Attachment\AttachmentRepository($eventStorage, $snapshotStorage)
			));
		
		// Behaviour
		$router
			->route(Behaviour\Command\CreateBehaviour::class)
			->to(new Behaviour\Command\CreateBehaviourHandler(
				new Persist\Behaviour\BehaviourRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Behaviour\Command\ChangeBehaviour::class)
			->to(new Behaviour\Command\ChangeBehaviourHandler(
				new Persist\Behaviour\BehaviourRepository($eventStorage, $snapshotStorage)
			));
		
		// Dictionary
		$router
			->route(Dictionary\Command\CreateDictionary::class)
			->to(new Dictionary\Command\CreateDictionaryHandler(
				new Persist\Dictionary\DictionaryRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Dictionary\Command\ChangeDictionary::class)
			->to(new Dictionary\Command\ChangeDictionaryHandler(
				new Persist\Dictionary\DictionaryRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Dictionary\Command\RemoveDictionary::class)
			->to(new Dictionary\Command\RemoveDictionaryHandler(
				new Persist\Dictionary\DictionaryRepository($eventStorage, $snapshotStorage)
			));
		
		// Rga
		$router
			->route(Rga\Command\ChangeApplicantRga::class)
			->to(new Rga\Command\ChangeApplicantRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Rga\Command\ChangeFlagsRga::class)
			->to(new Rga\Command\ChangeFlagsRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Rga\Command\ChangeNoteRga::class)
			->to(new Rga\Command\ChangeNoteRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Rga\Command\ChangeStateRga::class)
			->to(new Rga\Command\ChangeStateRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Rga\Command\CreateRga::class)
			->to(new Rga\Command\CreateRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage),
				new Persist\Attachment\AttachmentRepository($eventStorage, $snapshotStorage),
				new Rga\Integration\Warranty\Calculator($container->get(ConfigInterface::class))
			));
		
		$router
			->route(Rga\Command\RemoveRga::class)
			->to(new Rga\Command\RemoveRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Rga\Command\SetPackageRga::class)
			->to(new Rga\Command\SetPackageRgaHandler(
				new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage)
			));
		
		// State
		$router
			->route(State\Command\CreateState::class)
			->to(new State\Command\CreateStateHandler(
				new Persist\State\StateRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(State\Command\ChangeState::class)
			->to(new State\Command\ChangeStateHandler(
				new Persist\State\StateRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(State\Command\RemoveState::class)
			->to(new State\Command\RemoveStateHandler(
				new Persist\State\StateRepository($eventStorage, $snapshotStorage)
			));
		
		// Transport
		$router
			->route(Transport\Command\CreateTransport::class)
			->to(new Transport\Command\CreateTransportHandler(
				new Persist\Transport\TransportRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Transport\Command\ChangeTransport::class)
			->to(new Transport\Command\ChangeTransportHandler(
				new Persist\Transport\TransportRepository($eventStorage, $snapshotStorage)
			));
		
		$router
			->route(Transport\Command\RemoveTransport::class)
			->to(new Transport\Command\RemoveTransportHandler(
				new Persist\Transport\TransportRepository($eventStorage, $snapshotStorage)
			));
		
		$bus = new CommandBus();
		$bus->setRouter($router);
		
		return $bus;
	}
}