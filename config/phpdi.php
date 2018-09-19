<?php

use RGA\Application\SegregationSourcing;
use RGA\Application\Service;
use RGA\Domain\Model\Rga;
use Psr\Container\ContainerInterface;
use RGA\Infrastructure\Source;

return [
	
	Source\Service\StandardService::class  => Source\Service\StandardService::class,
	
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

	Service\Behaviour\BehaviourService::class => function (ContainerInterface $container) {
		$service = new Service\Behaviour\BehaviourService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	},
	
	Service\Dictionary\DictionaryService::class => function (ContainerInterface $container) {
		$service = new Service\Dictionary\DictionaryService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	},
	
	Service\ReturnPackage\ReturnPackageService::class => function (ContainerInterface $container) {
		$service = new Service\ReturnPackage\ReturnPackageService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	},
	
	Service\Rga\RgaService::class => function (ContainerInterface $container) {
		$service = new Service\Rga\RgaService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	},
	
	Service\State\StateService::class => function (ContainerInterface $container) {
		$service = new Service\State\StateService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	},
	
	Service\Transport\TransportService::class => function (ContainerInterface $container) {
		$service = new Service\Transport\TransportService(
			SegregationSourcing\Command\CommandHandling\CommandBusFactory::get($container)
		);
		
		return $service;
	}
];