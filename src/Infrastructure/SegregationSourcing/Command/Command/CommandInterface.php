<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\Command;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

interface CommandInterface
	extends MessageInterface
{
	/**
	 * @return string
	 */
	public function getUuid(): string;
	
	/**
	 * @param string $uuid
	 */
	public function setUuid(string $uuid): void;
}