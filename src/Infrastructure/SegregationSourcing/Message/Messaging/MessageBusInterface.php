<?php

namespace RGA\Infrastructure\SegregationSourcing\Message\Messaging;

use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;

interface MessageBusInterface
{
	/**
	 * @param RouterInterface $router
	 */
	public function setRouter(RouterInterface $router): void;
}