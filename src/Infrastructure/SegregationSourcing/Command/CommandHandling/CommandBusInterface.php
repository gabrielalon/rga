<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

use RGA\Infrastructure\SegregationSourcing\Command\Command\CommandInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;

interface CommandBusInterface
	extends MessageBusInterface
{
	public function dispatch(CommandInterface $command);
}