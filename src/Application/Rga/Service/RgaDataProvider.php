<?php

namespace RGA\Application\Rga\Service;

use RGA\Domain\Model\Rga\Rga;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface RgaDataProvider
	extends DataProviderInterface
{
	/**
	 * @return string
	 */
	public function stateUuid(): string;
	
	/**
	 * @return Rga\Applicant\Applicant
	 */
	public function getApplicant(): Rga\Applicant\Applicant;
	
	/**
	 * @return Rga\Applicant\Address
	 */
	public function getAddress(): Rga\Applicant\Address;
	
	/**
	 * @return Rga\Applicant\Bank
	 */
	public function getBank(): Rga\Applicant\Bank;
	
	/**
	 * @return Rga\Applicant\Contact
	 */
	public function getContact(): Rga\Applicant\Contact;
	
	/**
	 * @return Rga\Reference\References
	 */
	public function getReferences(): Rga\Reference\References;
	
	/**
	 * @return RgaObject
	 */
	public function getSourceObject(): RgaObject;
	
	/**
	 * @return array
	 */
	public function getItems(): array;
	
	/**
	 * @return bool
	 */
	public function isProductReceived(): bool;
	
	/**
	 * @return bool
	 */
	public function isCashReceived(): bool;
	
	/**
	 * @return bool
	 */
	public function isProductReturned(): bool;
	
	/**
	 * @return string
	 */
	public function adminNotesForApplicant(): string;
	
	/**
	 * @return string
	 */
	public function adminNotes(): string;
}