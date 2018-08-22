<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Domain\Model\Base\Rga;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\RgaRepositoryInterface;

class InMemoryRgaRepository
	implements RgaRepositoryInterface
{
	/** @var Rga[] */
	private $rgas = [];
	
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	public function find($uuid): Rga
	{
		$uuid = (string)$uuid;
		if (isset($this->rgas[$uuid]))
		{
			return clone $this->rgas[$uuid];
		}
		
		throw new NotFound('Rga', $uuid);
	}
	
	/**
	 * @param Rga $rga
	 */
	public function save(Rga $rga): void
	{
		$this->rgas[(string)$rga->getUuid()] = $rga;
	}
	
	/**
	 * @param string $uuid
	 */
	public function delete($uuid): void
	{
		unset($this->rgas[(string)$uuid]);
	}
	
	/**
	 * @return int
	 */
	public function getNextGroupNumber(): int
	{
		$number = 0;
		
		foreach ($this->rgas as $rga)
		{
			$number = $rga->getIndividualGroup();
		}
		
		return $number + 1;
	}
	
	/**
	 * @return int
	 */
	public function getNextIndividualNumber(): int
	{
		$number = 0;
		
		foreach ($this->rgas as $rga)
		{
			$number = $rga->getIndividualNumber();
		}
		
		return $number + 1;
	}
	
	public function beginTransaction(): void
	{}
	
	public function commitTransaction(): void
	{}
	
	public function rollBackTransaction(): void
	{}
}