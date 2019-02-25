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
	public function route($eventName);
	
	/**
	 * @param callable $listener
	 * @return EventRouterInterface
	 */
	public function to($listener): EventRouterInterface;
	
	/**
	 * @param callable $listener
	 * @return EventRouterInterface
	 */
	public function andTo($listener): EventRouterInterface;
	
	/**
	 * @return array
	 */
	public function getMap(): array;
	
	/**
	 * @param EventRouterInterface $router
	 */
	public function merge(EventRouterInterface $router): void;
	
	/**
	 * @param string $messageName
	 * @return callable[]
	 */
	public function map($messageName);
	
	/**
	 * @param MessageBusInterface $bus
	 */
	public function attachToMessageBus(MessageBusInterface $bus);
}