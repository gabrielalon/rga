<?php

namespace RGA\Application\Service\Rga;

use RGA\Application\Service;
use RGA\Domain\Model\Rga\Command;

class RgaService
	extends Service\AbstractService
{
	/**
	 * @param RgaDataProvider $provider
	 */
	public function changeApplicant(RgaDataProvider $provider): void
	{
		$command = new Command\ChangeApplicantRga(
			$provider->uuid(),
			$provider->getAddress(),
			$provider->getContact(),
			$provider->getBank()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param RgaDataProvider $provider
	 */
	public function changeFlags(RgaDataProvider $provider): void
	{
		$command = new Command\ChangeFlagsRga(
			$provider->uuid(),
			$provider->isProductReceived(),
			$provider->isCashReceived(),
			$provider->isProductReturned(),
			$provider->adminNotesForApplicant()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param RgaDataProvider $provider
	 */
	public function changeNote(RgaDataProvider $provider): void
	{
		$command = new Command\ChangeNoteRga(
			$provider->uuid(),
			$provider->adminNotes()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param RgaDataProvider $provider
	 */
	public function changeState(RgaDataProvider $provider): void
	{
		$command = new Command\ChangeStateRga(
			$provider->uuid(),
			$provider->stateUuid()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param RgaDataProvider $provider
	 */
	public function create(RgaDataProvider $provider): void
	{
		$command = new Command\CreateRga(
			$provider->uuid(),
			$provider->getReferences(),
			$provider->getItems(),
			$provider->getApplicant(),
			$provider->getAddress(),
			$provider->getContact(),
			$provider->getBank(),
			$provider->getSourceObject()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param string $uuid
	 */
	public function remove(string $uuid): void
	{
		$command = new Command\RemoveRga($uuid);
		
		$this->handle($command);
	}
	
	/**
	 * @param RgaPackageDataProvider $provider
	 */
	public function setPackage(RgaPackageDataProvider $provider): void
	{
		$command = new Command\SetPackageRga(
			$provider->uuid(),
			$provider->packageNo(),
			$provider->setAt()->format('Y-m-d H:i:s')
		);
		
		$this->handle($command);
	}
}