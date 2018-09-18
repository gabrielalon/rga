<?php

namespace RGA\Infrastructure\Persist\ReturnPackage;

use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class ReturnPackageRepository
	extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return ReturnPackage::class;
	}
	
	/**
	 * @param ReturnPackage $dictionary
	 */
	public function save(ReturnPackage $dictionary): void
	{
		$this->saveAggregateRoot($dictionary);
	}
	
	/**
	 * @param string $uuid
	 * @return ReturnPackage
	 */
	public function find(string $uuid): ReturnPackage
	{
		/** @var ReturnPackage $dictionary */
		$dictionary = $this->findAggregateRoot($uuid);
		
		return $dictionary;
	}
}