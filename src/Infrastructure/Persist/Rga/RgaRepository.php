<?php

namespace RGA\Infrastructure\Persist\Rga;

use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class RgaRepository
	extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Rga::class;
	}
	
	/**
	 * @param Rga $rga
	 */
	public function save(Rga $rga): void
	{
		$this->saveAggregateRoot($rga);
	}
	
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	public function find(string $uuid): Rga
	{
		/** @var Rga $rga */
		$rga = $this->findAggregateRoot($uuid);
		
		return $rga;
	}
}