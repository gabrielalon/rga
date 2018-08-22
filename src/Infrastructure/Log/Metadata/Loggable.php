<?php

namespace RGA\Infrastructure\Log\Metadata;

use RGA\Infrastructure\Model\Identify\Guidable;

interface Loggable
	extends Guidable
{
	/**
	 * @return array
	 */
	public function toArray(): array;
}