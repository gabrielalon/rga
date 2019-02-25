<?php

namespace RGA\Domain\Model\Dictionary\Projection;

use RGA\Application\Dictionary\Event;

interface DictionaryProjectorInterface
{
	/**
	 * @param Event\NewDictionaryCreated $event
	 */
	public function onNewDictionaryCreated(Event\NewDictionaryCreated $event): void;
	
	/**
	 * @param Event\ExistingDictionaryChanged $event
	 */
	public function onExistingDictionaryChanged(Event\ExistingDictionaryChanged $event): void;
	
	/**
	 * @param Event\ExistingDictionaryRemoved $event
	 */
	public function onExistingDictionaryRemoved(Event\ExistingDictionaryRemoved $event): void;
}