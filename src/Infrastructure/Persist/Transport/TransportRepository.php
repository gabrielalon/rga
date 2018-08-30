<?php

namespace RGA\Infrastructure\Persist\Transport;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class TransportRepository
	extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Transport::class;
	}
	
	/**
	 * @param Transport $dictionary
	 */
	public function save(Transport $dictionary): void
	{
		$this->saveAggregateRoot($dictionary);
	}
	
	/**
	 * @param string $uuid
	 * @return Transport
	 */
	public function find(string $uuid): Transport
	{
		/** @var Transport $transport */
		$transport = $this->findAggregateRoot($uuid);
		
		return $transport;
	}
}