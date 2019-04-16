<?php

namespace RGA\Domain\Model\Rga\Projection;

use RGA\Application\Rga\Event;

interface RgaProjectorInterface
{
    /**
     * @param Event\ApplicantRgaChanged $event
     */
    public function onApplicantRgaChanged(Event\ApplicantRgaChanged $event): void;
    
    /**
     * @param Event\ExistingRgaRemoved $event
     */
    public function onExistingRgaRemoved(Event\ExistingRgaRemoved $event): void;
    
    /**
     * @param Event\FlagsRgaChanged $event
     */
    public function onFlagsRgaChanged(Event\FlagsRgaChanged $event): void;
    
    /**
     * @param Event\NoteRgaChanged $event
     */
    public function onNoteRgaChanged(Event\NoteRgaChanged $event): void;
    
    /**
     * @param Event\NewRgaCreated $event
     */
    public function onNewRgaCreated(Event\NewRgaCreated $event): void;
    
    /**
     * @param Event\PackageRgaSet $event
     */
    public function onPackageRgaSet(Event\PackageRgaSet $event): void;
    
    /**
     * @param Event\StateRgaChanged $event
     */
    public function onStateRgaChanged(Event\StateRgaChanged $event): void;
}
