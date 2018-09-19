<?php

namespace RGA\Application\Service\Rga;

use RGA\Application\Service\DataProviderInterface;
use RGA\Domain\Model\Rga\Rga;

interface RgaApplicantProvider
	extends DataProviderInterface
{
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
}