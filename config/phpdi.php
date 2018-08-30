<?php

use RGA\Domain\Model\Rga;
use Psr\Container\ContainerInterface;
use RGA\Infrastructure\Source;

return [
	
	Source\Service\StandardService::class  => Source\Service\StandardService::class,
	Source\Warranty\ConfigInterface::class => Rga\Integration\Warranty\Config::class,
	
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
	}
];