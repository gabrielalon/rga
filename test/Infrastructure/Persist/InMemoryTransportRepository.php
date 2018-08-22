<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\Transport\TransportRepositoryInterface;

class InMemoryTransportRepository
	implements TransportRepositoryInterface
{
	/** @var Transport[] */
	private $transports = [];

	/**
	 * @inheritdoc
	 */
	public function save(Transport $transport): void
	{
		$this->transports[(string)$transport->getUuid()] = $transport;
	}

	/**
	 * @param string $guid
	 * @return Transport
	 * @throws NotFound
	 */
	public function find($guid): Transport
	{
		if (isset($this->transports[$guid]))
		{
			return clone $this->transports[$guid];
		}

		throw new NotFound('Transport', $guid);
	}

	/**
	 * @param string $guid
	 */
	public function delete($guid): void
	{
		unset($this->transports[$guid]);
	}
}

