<?php

namespace RGA\Infrastructure\Log\Service;

use RGA\Infrastructure\Log\Blamable\AdminInterface;
use RGA\Infrastructure\Log\Metadata\Loggable;
use RGA\Infrastructure\Log\Type\LogTypeInterface;

interface LoggerInterface
{
	/**
	 * @param Loggable $meta
	 * @param LogTypeInterface $type
	 * @param AdminInterface $admin
	 */
	public function log(Loggable $meta, LogTypeInterface $type, AdminInterface $admin): void;
}