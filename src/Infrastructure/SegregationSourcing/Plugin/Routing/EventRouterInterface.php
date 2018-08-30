<?php

namespace RGA\Infrastructure\SegregationSourcing\Plugin\Routing;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;

interface EventRouterInterface
	extends RouterInterface
{
	/**
	 * @param string $eventName
	 * @return EventRouterInterface
	 */
	public function route($eventName): EventRouterInterface;
	
	/**
	 * @param callable $listener
	 */
	public function to($listener): void;
	
	/**
	 * @param callable $listener
	 */
	public function andTo($listener): void;
	
	/**
	 * @param string $messageName
	 * @return callable[]
	 */
	public function map($messageName): array;
	
	/**
	 * @param MessageBusInterface $bus
	 */
	public function attachToMessageBus(MessageBusInterface $bus): void;
}