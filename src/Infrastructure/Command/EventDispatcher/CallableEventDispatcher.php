<?php

namespace RGA\Infrastructure\Command\EventDispatcher;

class CallableEventDispatcher
	implements EventDispatcherInterface
{
	private $listeners = [];
	
	/**
	 * {@inheritDoc}
	 */
	public function dispatch($eventName, array $arguments = [])
	{
		if (false === isset($this->listeners[$eventName]))
		{
			return;
		}
		
		foreach ($this->listeners[$eventName] as $listener)
		{
			call_user_func_array($listener, $arguments);
		}
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function addListener($eventName, /* callable */ $callable)
	{
		if (false === isset($this->listeners[$eventName]))
		{
			$this->listeners[$eventName] = [];
		}
		
		$this->listeners[$eventName][] = $callable;
	}
}