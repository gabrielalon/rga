<?php

namespace RGA\Infrastructure\Log\Type;

interface LogTypeInterface
{
	/**
	 * @return string
	 */
	public function getType(): string;
}