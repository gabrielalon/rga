<?php

namespace RGA\Domain\Model\Dictionary\Event;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingDictionaryChanged
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Dictionary\Entries
	 */
	public function dictionaryValues(): Dictionary\Entries
	{
		return Dictionary\Entries::fromArray((array)($this->payload['values'] ? \unserialize($this->payload['values'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Dictionary $dictionary
	 */
	public function populate(Aggregate\AggregateRoot $dictionary): void
	{
		$dictionary->setEntries($this->dictionaryValues());
	}
}