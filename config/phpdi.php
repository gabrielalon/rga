<?php

use Psr\Container\ContainerInterface;
use RGA\Application\Additional;
use RGA\Application\Attachment;
use RGA\Application\Behaviour;
use RGA\Application\Dictionary;
use RGA\Application\ReturnPackage;
use RGA\Application\Rga;
use RGA\Application\SegregationSourcing AS SS;
use RGA\Application\Source AS aSource;
use RGA\Application\State;
use RGA\Application\Transport;
use RGA\Domain\Model;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\Projection;
use RGA\Infrastructure\Source;
use RGA\Infrastructure\SegregationSourcing;
use RGA\Infrastructure\Query;

return [
	
	Source\Service\BaserInterface::class => Source\Service\Baser64::class,
	Source\Service\StandardService::class => function (ContainerInterface $container) {
		$service = new Source\Service\StandardService(
			$container->get(Source\Service\BaserInterface::class)
		);
		
		return $service;
	},
	
	Source\Warranty\ConfigInterface::class => function (ContainerInterface $container) {
		$config = new Rga\Integration\Warranty\Config(
			$container->get(Source\Warranty\ConfigStorage\ConfigStorageInterface::class)
		);
		
		return $config;
	},
	
	Rga\Integration\Warranty\Calculator::class => function (ContainerInterface $container) {
		$calculator = new Rga\Integration\Warranty\Calculator(
			$container->get(Source\Warranty\ConfigInterface::class)
		);
		
		return $calculator;
	},
	
	Source\Registry\RegistryInterface::class => function (ContainerInterface $container) {
		$registry = new Source\Registry\StandardRegistry();
		$registry->put($container->get(Source\Service\StandardService::class));
		
		return $registry;
	},
	
	Source\RgaObjectQuery\ObjectQueryInterface::class => function (ContainerInterface $container) {
		$query = new Source\RgaObjectQuery\StandardQuery(
			$container->get(Source\Registry\RegistryInterface::class)
		);
		
		return $query;
	},
	
	aSource\Query\RgaObjectQueryInterface::class => function (ContainerInterface $container)
	{
		/** @var Source\RgaObjectQuery\ObjectQueryInterface $objectQuery */
		$objectQuery = $container->get(Source\RgaObjectQuery\ObjectQueryInterface::class);
		
		return new Query\Source\RgaObjectQuery($objectQuery);
	},
	
	aSource\Service\RgaObjectQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new aSource\Service\RgaObjectQueryManager($queryBus);
	},
	
	SegregationSourcing\Plugin\Routing\CommandRouterInterface::class => SegregationSourcing\Command\Plugin\CommandRouter::class,
	SegregationSourcing\Plugin\Routing\EventRouterInterface::class => SegregationSourcing\Event\Plugin\EventRouter::class,
	SegregationSourcing\Plugin\Routing\QueryRouterInterface::class => SegregationSourcing\Query\Plugin\QueryRouter::class,
	
	SegregationSourcing\Event\Persist\EventStreamRepositoryInterface::class => Query\EventStream\InMemoryEventStreamRepository::class,
	SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface::class => Query\Snapshot\InMemorySnapshotRepository::class,
	
	SegregationSourcing\Event\EventStore\EventStorage::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Event\Persist\EventStreamRepositoryInterface $storageRepository */
		$storageRepository = $container->get(SegregationSourcing\Event\Persist\EventStreamRepositoryInterface::class);
		
		return new SegregationSourcing\Event\EventStore\EventStorage($storageRepository);
	},
	
	SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface $snapshotRepository */
		$snapshotRepository = $container->get(SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface::class);
		
		return new SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage($snapshotRepository);
	},
	
	SegregationSourcing\Query\Querying\QueryBusFactoryCollection::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Plugin\QueryRouter $queryRouter */
		$queryRouter = $container->get(SegregationSourcing\Plugin\Routing\QueryRouterInterface::class);
		
		$collection = new SegregationSourcing\Query\Querying\QueryBusFactoryCollection();
		$collection->register(new Additional\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new Attachment\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new Behaviour\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new Dictionary\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new ReturnPackage\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new Rga\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new aSource\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new State\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new SS\Query\QueryHandling\QueryBusFactory($queryRouter));
		$collection->register(new Transport\Query\QueryHandling\QueryBusFactory($queryRouter));
		
		return $collection;
	},
	
	SegregationSourcing\Query\Querying\QueryBus::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Plugin\QueryRouter $queryRouter */
		$queryRouter = $container->get(SegregationSourcing\Plugin\Routing\QueryRouterInterface::class);
		
		$queryBus = new SegregationSourcing\Query\Querying\QueryBus($queryRouter);
		
		/** @var SegregationSourcing\Query\Querying\QueryBusFactoryCollection $collection */
		$collection = $container->get(SegregationSourcing\Query\Querying\QueryBusFactoryCollection::class);
		$collection->populate($queryBus, $container);
		
		return $queryBus;
	},
	
	SegregationSourcing\Event\EventSourcing\EventBusFactoryCollection::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Event\Plugin\EventRouter $eventRouter */
		$eventRouter = $container->get(SegregationSourcing\Plugin\Routing\EventRouterInterface::class);
		
		$collection = new SegregationSourcing\Event\EventSourcing\EventBusFactoryCollection();
		$collection->register(new Additional\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new Attachment\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new Behaviour\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new Dictionary\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new ReturnPackage\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new Rga\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new State\Event\EventSourcing\EventBusFactory($eventRouter));
		$collection->register(new Transport\Event\EventSourcing\EventBusFactory($eventRouter));
		
		return $collection;
	},
	
	SegregationSourcing\Event\EventStore\BusBridge\EventPublisher::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Event\EventSourcing\EventBus $eventBus */
		$eventBus = $container->get(SegregationSourcing\Event\EventSourcing\EventBus::class);
		
		return new SegregationSourcing\Event\EventStore\BusBridge\EventPublisher($eventBus);
	},
	
	SegregationSourcing\Event\EventSourcing\EventBus::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Event\Plugin\EventRouter $eventRouter */
		$eventRouter = $container->get(SegregationSourcing\Plugin\Routing\EventRouterInterface::class);
		
		$eventBus = new SegregationSourcing\Event\EventSourcing\EventBus($eventRouter);
		
		/** @var SegregationSourcing\Event\EventSourcing\EventBusFactoryCollection $collection */
		$collection = $container->get(SegregationSourcing\Event\EventSourcing\EventBusFactoryCollection::class);
		$collection->populate($eventBus, $container);
		
		return $eventBus;
	},
	
	SegregationSourcing\Command\CommandHandling\CommandBusFactoryCollection::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\Plugin\CommandRouter $commandRouter */
		$commandRouter = $container->get(SegregationSourcing\Plugin\Routing\CommandRouterInterface::class);
		/** @var SegregationSourcing\Event\EventStore\EventStorage $eventStorage */
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		
		$collection = new SegregationSourcing\Command\CommandHandling\CommandBusFactoryCollection();
		$collection->register(new Additional\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new Attachment\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new Behaviour\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new Dictionary\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new ReturnPackage\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new Rga\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new State\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		$collection->register(new Transport\Command\CommandHandling\CommandBusFactory($commandRouter, $eventStorage));
		
		$eventPublisher = $container->get(SegregationSourcing\Event\EventStore\BusBridge\EventPublisher::class);
		$eventPublisher->attachToEventStorage($eventStorage);
		
		return $collection;
	},
	
	SegregationSourcing\Command\CommandHandling\CommandBus::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\Plugin\CommandRouter $commandRouter */
		$commandRouter = $container->get(SegregationSourcing\Plugin\Routing\CommandRouterInterface::class);
		
		$commandBus = new SegregationSourcing\Command\CommandHandling\CommandBus($commandRouter);
		
		$collection = $container->get(SegregationSourcing\Command\CommandHandling\CommandBusFactoryCollection::class);
		$collection->populate($commandBus, $container);
		
		return $commandBus;
	},
	
	// Additional
	
	Model\Additional\Projection\AdditionalProjectorInterface::class => Projection\Additional\InMemoryAdditionalProjector::class,
	
	Additional\Query\V1\AdditionalQueryInterface::class => Query\Additional\InMemoryAdditionalQuery::class,
	
	Persist\Additional\AdditionalRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Additional\AdditionalRepository($eventStorage, $snapshotStorage);
	},
	
	Additional\Service\AdditionalQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Additional\Service\AdditionalQueryManager($queryBus);
	},
	
	// Attachment
	
	Model\Attachment\Projection\AttachmentProjectorInterface::class => Projection\Attachment\InMemoryAttachmentProjector::class,
	
	Attachment\Query\V1\AttachmentQueryInterface::class => Query\Attachment\InMemoryAttachmentQuery::class,
	
	Persist\Attachment\AttachmentRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Attachment\AttachmentRepository($eventStorage, $snapshotStorage);
	},
	
	Attachment\Service\AttachmentCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new Attachment\Service\AttachmentCommandManager($commandBus);
	},
	
	Attachment\Service\AttachmentQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Attachment\Service\AttachmentQueryManager($queryBus);
	},
	
	// Behaviour
	
	Model\Behaviour\Projection\BehaviourProjectorInterface::class => Projection\Behaviour\InMemoryBehaviourProjector::class,
	
	Behaviour\Query\V1\BehaviourQueryInterface::class => Query\Behaviour\InMemoryBehaviourQuery::class,
	
	Persist\Behaviour\BehaviourRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Behaviour\BehaviourRepository($eventStorage, $snapshotStorage);
	},

	Behaviour\Service\BehaviourCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new Behaviour\Service\BehaviourCommandManager($commandBus);
	},
	
	Behaviour\Service\BehaviourQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Behaviour\Service\BehaviourQueryManager($queryBus);
	},
	
	// Dictionary
	
	Model\Dictionary\Projection\DictionaryProjectorInterface::class => Projection\Dictionary\InMemoryDictionaryProjector::class,
	
	Dictionary\Query\V1\DictionaryQueryInterface::class => Query\Dictionary\InMemoryDictionaryQuery::class,
	
	Persist\Dictionary\DictionaryRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Dictionary\DictionaryRepository($eventStorage, $snapshotStorage);
	},
	
	Dictionary\Service\DictionaryCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new Dictionary\Service\DictionaryCommandManager($commandBus);
	},
	
	Dictionary\Service\DictionaryQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Dictionary\Service\DictionaryQueryManager($queryBus);
	},
	
	// ReturnPackage
	
	Model\ReturnPackage\Projection\ReturnPackageProjectorInterface::class => Projection\ReturnPackage\InMemoryReturnPackageProjector::class,
	
	ReturnPackage\Query\V1\ReturnPackageQueryInterface::class => Query\ReturnPackage\InMemoryReturnPackageQuery::class,
	
	Persist\ReturnPackage\ReturnPackageRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\ReturnPackage\ReturnPackageRepository($eventStorage, $snapshotStorage);
	},
	
	ReturnPackage\Service\ReturnPackageCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new ReturnPackage\Service\ReturnPackageCommandManager($commandBus);
	},
	
	ReturnPackage\Service\ReturnPackageQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new ReturnPackage\Service\ReturnPackageQueryManager($queryBus);
	},
	
	// Rga
	
	Model\Rga\Projection\RgaProjectorInterface::class => Projection\Rga\InMemoryRgaProjector::class,
	
	Rga\Query\V1\RgaQueryInterface::class => Query\Rga\InMemoryRgaQuery::class,
	
	Rga\Query\Decorator\RgaDecorator::class => Rga\Query\Decorator\RgaDecorator::class,
	
	Rga\Integration\Warranty\Calculator::class => function (ContainerInterface $container)
	{
		/** @var Source\Warranty\ConfigInterface $config */
		$config = $container->get(Source\Warranty\ConfigInterface::class);
		
		return new Rga\Integration\Warranty\Calculator($config);
	},
	
	Persist\Rga\RgaRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Rga\RgaRepository($eventStorage, $snapshotStorage);
	},
	
	Rga\Service\RgaCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new Rga\Service\RgaCommandManager($commandBus);
	},
	
	Rga\Service\RgaQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Rga\Service\RgaQueryManager($queryBus);
	},
	
	// State
	
	Model\State\Projection\StateProjectorInterface::class => Projection\State\InMemoryStateProjector::class,
	
	State\Query\V1\StateQueryInterface::class => Query\State\InMemoryStateQuery::class,
	
	Persist\State\StateRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\State\StateRepository($eventStorage, $snapshotStorage);
	},
	
	State\Service\StateCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new State\Service\StateCommandManager($commandBus);
	},
	
	State\Service\StateQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new State\Service\StateQueryManager($queryBus);
	},
	
	// Transport
	
	Model\Transport\Projection\TransportProjectorInterface::class => Projection\Transport\InMemoryTransportProjector::class,
	
	Transport\Query\V1\TransportQueryInterface::class => Query\Transport\InMemoryTransportQuery::class,
	
	Persist\Transport\TransportRepository::class => function (ContainerInterface $container)
	{
		$eventStorage = $container->get(SegregationSourcing\Event\EventStore\EventStorage::class);
		$snapshotStorage = $container->get(SegregationSourcing\Snapshot\SnapshotStore\SnapshotStorage::class);
		
		return new Persist\Transport\TransportRepository($eventStorage, $snapshotStorage);
	},
	
	Transport\Service\TransportCommandManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Command\CommandHandling\CommandBus $commandBus */
		$commandBus = $container->get(SegregationSourcing\Command\CommandHandling\CommandBus::class);
		
		return new Transport\Service\TransportCommandManager($commandBus);
	},
	
	Transport\Service\TransportQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new Transport\Service\TransportQueryManager($queryBus);
	},
	
	SegregationSourcing\Service\CommandManager::class => function (ContainerInterface $container)
	{
		$registry = new SegregationSourcing\Service\CommandManagerRegistry();
		
		$registry->register($container->get(Attachment\Service\AttachmentCommandManager::class));
		$registry->register($container->get(Behaviour\Service\BehaviourCommandManager::class));
		$registry->register($container->get(Dictionary\Service\DictionaryCommandManager::class));
		$registry->register($container->get(ReturnPackage\Service\ReturnPackageCommandManager::class));
		$registry->register($container->get(Rga\Service\RgaCommandManager::class));
		$registry->register($container->get(State\Service\StateCommandManager::class));
		$registry->register($container->get(Transport\Service\TransportCommandManager::class));
		
		return new SegregationSourcing\Service\CommandManager($registry);
	},
	
	SegregationSourcing\Service\QueryManager::class => function (ContainerInterface $container)
	{
		$registry = new SegregationSourcing\Service\QueryManagerRegistry();
		
		$registry->register($container->get(Additional\Service\AdditionalQueryManager::class));
		$registry->register($container->get(Attachment\Service\AttachmentQueryManager::class));
		$registry->register($container->get(Behaviour\Service\BehaviourQueryManager::class));
		$registry->register($container->get(Dictionary\Service\DictionaryQueryManager::class));
		$registry->register($container->get(ReturnPackage\Service\ReturnPackageQueryManager::class));
		$registry->register($container->get(Rga\Service\RgaQueryManager::class));
		$registry->register($container->get(State\Service\StateQueryManager::class));
		$registry->register($container->get(SS\Service\StorageEventQueryManager::class));
		$registry->register($container->get(Transport\Service\TransportQueryManager::class));
		$registry->register($container->get(aSource\Service\RgaObjectQueryManager::class));
		
		return new SegregationSourcing\Service\QueryManager($registry);
	},
	
	// ----------------------------------------------------
	
	SS\Query\V1\StorageEventQueryInterface::class => Query\EventStream\InMemoryStorageEventQuery::class,
	
	SS\Service\StorageEventQueryManager::class => function (ContainerInterface $container)
	{
		/** @var SegregationSourcing\Query\Querying\QueryBus $queryBus */
		$queryBus = $container->get(SegregationSourcing\Query\Querying\QueryBus::class);
		
		return new SS\Service\StorageEventQueryManager($queryBus);
	},
	
	SS\Query\Decorator\DescriptionDecoratorRegistry::class => SS\Query\Decorator\DescriptionDecoratorRegistry::class,
	
	SS\Query\Decorator\StorageEventDecorator::class => function (ContainerInterface $container)
	{
		/** @var SS\Query\Decorator\DescriptionDecoratorRegistry $registry */
		$registry = $container->get(SS\Query\Decorator\DescriptionDecoratorRegistry::class);
		
		return new SS\Query\Decorator\StorageEventDecorator($registry);
	},
	
	Additional\Service\AdditionalServiceRegistry::class => function (ContainerInterface $container)
	{
		$registry = new Additional\Service\AdditionalServiceRegistry();
		$registry->put(new Additional\Service\EmptyAdditionalService());
		
		return $registry;
	},
	
	Additional\Query\Decorator\DescriptionDecoratorRegistry::class => function (ContainerInterface $container)
	{
		$registry = new Additional\Query\Decorator\DescriptionDecoratorRegistry();
		$registry->register(new Additional\Query\Decorator\Decorator\EmptyDescriptionDecorator());
		
		return $registry;
	},
	
	Additional\Query\Decorator\AdditionalDecorator::class => function (ContainerInterface $container)
	{
		/** @var Additional\Query\Decorator\DescriptionDecoratorRegistry $registry */
		$registry = $container->get(Additional\Query\Decorator\DescriptionDecoratorRegistry::class);
		
		return new Additional\Query\Decorator\AdditionalDecorator($registry);
	},
];