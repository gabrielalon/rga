<?php

namespace RGA\Infrastructure\Persist\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class DictionaryRepository
	extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Dictionary::class;
	}
	
	/**
	 * @param Dictionary $dictionary
	 */
	public function save(Dictionary $dictionary): void
	{
		$this->saveAggregateRoot($dictionary);
	}
	
	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public function find(string $uuid): Dictionary
	{
		/** @var Dictionary $dictionary */
		$dictionary = $this->findAggregateRoot($uuid);
		
		return $dictionary;
	}
}