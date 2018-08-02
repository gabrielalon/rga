<?php

namespace RGA\Infrastructure\Command\EventDispatcher;

interface EventDispatcherInterface
{
	/**
	 * @param string $eventName
	 * @param array  $arguments
	 */
	public function dispatch($eventName, array $arguments = []);
	
	/**
	 * @param string   $eventName
	 * @param callable $callable
	 */
	public function addListener($eventName, /* callable */ $callable);
}