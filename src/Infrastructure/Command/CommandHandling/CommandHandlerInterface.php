<?php

namespace RGA\Infrastructure\Command\CommandHandling;

use RGA\Infrastructure\Command\Command;

interface CommandHandlerInterface
{
	public function handle(Command\CommandInterface $command);
}