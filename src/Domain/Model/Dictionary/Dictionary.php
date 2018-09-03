<?php

namespace RGA\Domain\Model\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary as ValueObject;
use RGA\Domain\Model\Dictionary\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Dictionary
	extends Aggregate\AggregateRoot
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Entries */
	private $entries;
	
	/**
	 * @param Dictionary\Uuid $uuid
	 */
	public function setUuid(Dictionary\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param Dictionary\Type $type
	 */
	public function setType(Dictionary\Type $type): void
	{
		$this->type = $type;
	}
	
	/**
	 * @param Dictionary\Entries $entries
	 */
	public function setEntries(Dictionary\Entries $entries): void
	{
		$this->entries = $entries;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * @param Dictionary\Uuid $uuid
	 * @param Dictionary\Type $type
	 * @param Dictionary\Entries $values
	 * @return Dictionary
	 */
	public static function createNewDictionary(
		ValueObject\Uuid $uuid,
		ValueObject\Type $type,
		ValueObject\Entries $values
	): Dictionary
	{
		$dictionary = new Dictionary();
		
		$dictionary->recordThat(Event\NewDictionaryCreated::occur($uuid->toString(), [
			'type' => $type->toString(),
			'entries' => $values->toString()
		]));
		
		return $dictionary;
	}
	
	/**
	 * @param Dictionary\Entries $values
	 */
	public function changeExistingDictionary(ValueObject\Entries $values): void
	{
		$this->recordThat(Event\ExistingDictionaryChanged::occur($this->aggregateId(), [
			'entries' => $values->toString()
		]));
	}
	
	public function removeExistingDictionary(): void
	{
		$this->recordThat(Event\ExistingDictionaryRemoved::occur($this->aggregateId(), []));
	}
}