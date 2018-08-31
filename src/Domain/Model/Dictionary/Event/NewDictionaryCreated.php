<?php

namespace RGA\Domain\Model\Dictionary\Event;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\Dictionary\Enum;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewDictionaryCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Dictionary\Uuid
	 */
	public function dictionaryUuid(): Dictionary\Uuid
	{
		return Dictionary\Uuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return Dictionary\Type
	 */
	public function dictionaryType(): Dictionary\Type
	{
		return Dictionary\Type::fromString((string)($this->payload['type'] ?? Enum\Type::__default));
	}
	
	/**
	 * @return Dictionary\Values
	 */
	public function dictionaryValues(): Dictionary\Values
	{
		return Dictionary\Values::fromArray((array)($this->payload['values'] ? \unserialize($this->payload['values'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Dictionary $dictionary
	 */
	public function populate(Aggregate\AggregateRoot $dictionary): void
	{
		$dictionary->setUuid($this->dictionaryUuid());
		$dictionary->setType($this->dictionaryType());
		$dictionary->setValues($this->dictionaryValues());
	}
}