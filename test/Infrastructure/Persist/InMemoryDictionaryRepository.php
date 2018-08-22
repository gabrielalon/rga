<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepositoryInterface;
use RGA\Infrastructure\Persist\Exception\NotFound;

class InMemoryDictionaryRepository implements DictionaryRepositoryInterface
{
	/** @var Dictionary[] */
	private $dictionaries = [];

	/**
	 * @inheritdoc
	 */
	public function save(Dictionary $dictionary): void
	{
		$this->dictionaries[(string)$dictionary->getUuid()] = $dictionary;
	}

	/**
	 * @param string $guid
	 * @return Dictionary
	 */
	public function find(string $guid): Dictionary
	{
		if (isset($this->dictionaries[$guid]))
		{
			return clone $this->dictionaries[$guid];
		}

		throw new NotFound('Dictionary', $guid);
	}

	/**
	 * @param string $guid
	 */
	public function delete(string $guid): void
	{
		unset($this->dictionaries[$guid]);
	}
}

