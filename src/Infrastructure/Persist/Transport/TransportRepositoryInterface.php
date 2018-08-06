<?php

namespace RGA\Infrastructure\Persist\Transport;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\Persist\Exception\NotFound;

interface TransportRepositoryInterface
{
	/**
	 * @param string $id
	 * @return Transport
	 */
	public function find($id): Transport;

	/**
	 * @param Transport $model
	 */
	public function save(Transport $model);

	/**
	 * @param string $guid
	 * @return Transport
	 * @throws NotFound
	 */
	public function load(string $guid): Transport;
}