<?php

namespace RGA\Application\Service\ReturnPackage;

use RGA\Application\Service\AbstractService;
use RGA\Domain\Model\ReturnPackage\Command;

class ReturnPackageService
	extends AbstractService
{
	/**
	 * @param ReturnPackageDataProvider $provider
	 */
	public function create(ReturnPackageDataProvider $provider): void
	{
		$command = new Command\CreateReturnPackage(
			$provider->id(),
			$provider->rgaUuid(),
			$provider->transportUuid(),
			$provider->price()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param ReturnPackageDataProvider $provider
	 */
	public function setPackage(ReturnPackageDataProvider $provider): void
	{
		$command = new Command\SetReturnPackage(
			$provider->id(),
			$provider->packageNo(),
			$provider->setAt()->format('Y-m-d H:i:s')
		);
		
		$this->handle($command);
	}
}