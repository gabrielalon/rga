<?php

namespace RGA\Domain\Model\ReturnPackage\Projection;

use RGA\Domain\Model\ReturnPackage\Event;

interface ReturnPackageProjectorInterface
{
	/**
	 * @param Event\NewReturnPackageCreated $event
	 */
	public function onNewReturnPackageCreated(Event\NewReturnPackageCreated $event): void;
	
	/**
	 * @param Event\ReturnPackageSet $event
	 */
	public function onReturnPackageSet(Event\ReturnPackageSet $event): void;
}