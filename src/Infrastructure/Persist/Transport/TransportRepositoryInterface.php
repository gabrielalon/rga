<?php

namespace RGA\Infrastructure\Persist\Transport;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\Persist\Exception\NotFound;

interface TransportRepositoryInterface
{
	/**
	 * @param string $guid
	 * @return Transport
	 */
	public function find($guid): Transport;

	/**
	 * @param Transport $model
	 */
	public function save(Transport $model);

	/**
	 * @param string $guid
	 * @throws NotFound
	 */
	public function delete($guid): void;
}