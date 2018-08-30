<?php

namespace RGA\Application\SegregationSourcing\Command\Plugin;

use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\CommandRouterInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageHandlerInterface;

class CommandRouter
	implements CommandRouterInterface
{
	/** @var string */
	private $tmpMessageName;
	
	/** @var MessageHandlerInterface[] */
	private $handlerMap = [];
	
	/**
	 * @param string $messageName
	 * @return CommandRouterInterface
	 */
	public function route($messageName): CommandRouterInterface
	{
		if (true === empty($messageName))
		{
			throw new \InvalidArgumentException('Message name cannot be empty');
		}
		
		$this->tmpMessageName = $messageName;
		
		return $this;
	}
	
	/**
	 * @param MessageHandlerInterface $handler
	 */
	public function to(MessageHandlerInterface $handler): void
	{
		if (true === empty($this->tmpMessageName))
		{
			throw new \RuntimeException('Please provide message name first with route method');
		}
		
		$this->handlerMap[$this->tmpMessageName] = $handler;
	}
	
	/**
	 * @param string $messageName
	 * @return MessageHandlerInterface
	 */
	public function map($messageName): MessageHandlerInterface
	{
		return $this->handlerMap[$messageName];
	}
	
	/**
	 * @param MessageBusInterface $bus
	 */
	public function attachToMessageBus(MessageBusInterface $bus): void
	{
		$bus->setRouter($this);
	}
}