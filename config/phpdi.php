<?php

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
	}
];