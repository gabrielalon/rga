<?php

use RGA\Application;
use RGA\Infrastructure\Query\QueryHandling;
use RGA\Infrastructure\Command\CommandHandling;
use Psr\Container\ContainerInterface;
use RGA\Infrastructure\Source;

return [

	CommandHandling\Collector::class => function (ContainerInterface $container) {
		$collector = new CommandHandling\Collector();
		$collector->add($container->get(Application\Command\CommandHandler\BehaviourCommandHandler::class));
		$collector->add($container->get(Application\Command\CommandHandler\DictionaryCommandHandler::class));
		$collector->add($container->get(Application\Command\CommandHandler\RgaCommandHandler::class));
		$collector->add($container->get(Application\Command\CommandHandler\StateCommandHandler::class));
		$collector->add($container->get(Application\Command\CommandHandler\TransportCommandHandler::class));

		return $collector;
	},

	QueryHandling\Collector::class => function (ContainerInterface $container) {
		$collector = new QueryHandling\Collector();
		$collector->add($container->get(Application\Query\QueryHandler\BehaviourQueryHandler::class));
		$collector->add($container->get(Application\Query\QueryHandler\DictionaryQueryHandler::class));
		$collector->add($container->get(Application\Query\QueryHandler\RgaQueryHandler::class));
		$collector->add($container->get(Application\Query\QueryHandler\StateQueryhandler::class));
		$collector->add($container->get(Application\Query\QueryHandler\TransportQueryHandler::class));

		return $collector;
	},

	Application\Source\Service\StandardService::class => Application\Source\Service\StandardService::class,
	Source\Warranty\ConfigInterface::class            => Source\Warranty\Config::class,

	Application\Warranty\Calculator::class => function (ContainerInterface $container) {
		$calculator = new Application\Warranty\Calculator(
			$container->get(Source\Warranty\ConfigInterface::class)
		);

		return $calculator;
	},

	Source\Registry\RegistryInterface::class => function (ContainerInterface $container) {
		$registry = new Application\Source\Registry\StandardRegistry();
		$registry->put($container->get(Application\Source\Service\StandardService::class));

		return $registry;
	},

	Source\RgaObjectQuery\ObjectQueryInterface::class => function (ContainerInterface $container) {
		$query = new Application\Source\ObjectQuery\ObjectQuery(
			$container->get(Source\Registry\RegistryInterface::class)
		);

		return $query;
	}
];