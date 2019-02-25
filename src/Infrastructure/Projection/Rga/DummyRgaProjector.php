<?php

namespace RGA\Infrastructure\Projection\Rga;

use RGA\Application\Rga\Event;
use RGA\Domain\Model\Rga\Projection;

class DummyRgaProjector
	implements Projection\RgaProjectorInterface
{
	/**
	 * @param Event\ApplicantRgaChanged $event
	 */
	public function onApplicantRgaChanged(Event\ApplicantRgaChanged $event): void
	{
		// TODO: Implement onApplicantRgaChanged() method.
	}
	
	/**
	 * @param Event\ExistingRgaRemoved $event
	 */
	public function onExistingRgaRemoved(Event\ExistingRgaRemoved $event): void
	{
		// TODO: Implement onExistingRgaRemoved() method.
	}
	
	/**
	 * @param Event\FlagsRgaChanged $event
	 */
	public function onFlagsRgaChanged(Event\FlagsRgaChanged $event): void
	{
		// TODO: Implement onFlagsRgaChanged() method.
	}
	
	/**
	 * @param Event\NoteRgaChanged $event
	 */
	public function onNoteRgaChanged(Event\NoteRgaChanged $event): void
	{
		// TODO: Implement onNoteRgaChanged() method.
	}
	
	/**
	 * @param Event\NewRgaCreated $event
	 */
	public function onNewRgaCreated(Event\NewRgaCreated $event): void
	{
		// TODO: Implement onNewRgaCreated() method.
	}
	
	/**
	 * @param Event\PackageRgaSet $event
	 */
	public function onPackageRgaSet(Event\PackageRgaSet $event): void
	{
		// TODO: Implement onPackageRgaSet() method.
	}
	
	/**
	 * @param Event\StateRgaChanged $event
	 */
	public function onStateRgaChanged(Event\StateRgaChanged $event): void
	{
		// TODO: Implement onStateRgaChanged() method.
	}
}