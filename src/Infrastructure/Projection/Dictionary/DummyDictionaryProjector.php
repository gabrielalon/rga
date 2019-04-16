<?php

namespace RGA\Infrastructure\Projection\Dictionary;

use RGA\Application\Dictionary\Event;
use RGA\Domain\Model\Dictionary\Projection;

class DummyDictionaryProjector implements Projection\DictionaryProjectorInterface
{
    /**
     * @param Event\NewDictionaryCreated $event
     */
    public function onNewDictionaryCreated(Event\NewDictionaryCreated $event): void
    {
        // TODO: Implement onNewDictionaryCreated() method.
    }
    
    /**
     * @param Event\ExistingDictionaryChanged $event
     */
    public function onExistingDictionaryChanged(Event\ExistingDictionaryChanged $event): void
    {
        // TODO: Implement onExistingDictionaryChanged() method.
    }
    
    /**
     * @param Event\ExistingDictionaryRemoved $event
     */
    public function onExistingDictionaryRemoved(Event\ExistingDictionaryRemoved $event): void
    {
        // TODO: Implement onExistingDictionaryRemoved() method.
    }
}
