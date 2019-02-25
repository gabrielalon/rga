<?php

namespace RGA\Infrastructure\SegregationSourcing\Plugin\Routing;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageHandlerInterface;

interface CommandRouterInterface
	extends RouterInterface
{
	/**
	 * @param string $messageName
	 * @return CommandRouterInterface
	 */
	public function route($messageName);
	
	/**
	 * @param MessageHandlerInterface $handler
	 */
	public function to(MessageHandlerInterface $handler);
	
	/**
	 * @return array
	 */
	public function getMap(): array;
	
	/**
	 * @param CommandRouterInterface $router
	 */
	public function merge(CommandRouterInterface $router): void;
	
	/**
	 * @param string $messageName
	 * @return MessageHandlerInterface
	 */
	public function map($messageName);
	
	/**
	 * @param MessageBusInterface $bus
	 */
	public function attachToMessageBus(MessageBusInterface $bus);
}