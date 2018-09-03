<?php

namespace RGA\Infrastructure\Source\Warranty;

use RGA\Infrastructure\Source\Warranty\ConfigStorage\ConfigStorageInterface;

interface ConfigInterface
	extends Configurable
{
	/**
	 * @param ConfigStorageInterface $storage
	 */
	public function __construct(ConfigStorageInterface $storage);
}