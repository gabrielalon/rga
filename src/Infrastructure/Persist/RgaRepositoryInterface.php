<?php

namespace RGA\Infrastructure\Persist;

use RGA\Domain\Model\Base\Rga;

interface RgaRepositoryInterface
{
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	public function find($uuid): Rga;
	
	/**
	 * @param Rga $rga
	 */
	public function save(Rga $rga): void;
	
	/**
	 * @param string $uuid
	 */
	public function delete($uuid): void;
	
	/**
	 * @return int
	 */
	public function getNextGroupNumber(): int;
	
	/**
	 * @return int
	 */
	public function getNextIndividualNumber(): int;
	
	public function beginTransaction(): void;
	
	public function commitTransaction(): void;
	
	public function rollBackTransaction(): void;
}