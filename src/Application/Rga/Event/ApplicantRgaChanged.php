<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class ApplicantRgaChanged
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Rga\ApplicantContactPreference
	 */
	public function rgaApplicantContactPreference(): Rga\ApplicantContactPreference
	{
		return Rga\ApplicantContactPreference::fromString((string)($this->payload['applicant_contact_preference'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantEmail
	 */
	public function rgaApplicantEmail(): Rga\ApplicantEmail
	{
		return Rga\ApplicantEmail::fromString((string)($this->payload['applicant_email'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantTelephone
	 */
	public function rgaApplicantTelephone(): Rga\ApplicantTelephone
	{
		return Rga\ApplicantTelephone::fromString((string)($this->payload['applicant_telephone'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantFullName
	 */
	public function rgaApplicantFullName(): Rga\ApplicantFullName
	{
		return Rga\ApplicantFullName::fromString((string)($this->payload['applicant_full_name'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantStreetName
	 */
	public function rgaApplicantStreetName(): Rga\ApplicantStreetName
	{
		return Rga\ApplicantStreetName::fromString((string)($this->payload['applicant_street_name'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantBuildingNumber
	 */
	public function rgaApplicantBuildingNumber(): Rga\ApplicantBuildingNumber
	{
		return Rga\ApplicantBuildingNumber::fromString((string)($this->payload['applicant_building_number'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantApartmentNumber
	 */
	public function rgaApplicantApartmentNumber(): Rga\ApplicantApartmentNumber
	{
		return Rga\ApplicantApartmentNumber::fromString((string)($this->payload['applicant_apartment_number'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantPostalCode
	 */
	public function rgaApplicantPostalCode(): Rga\ApplicantPostalCode
	{
		return Rga\ApplicantPostalCode::fromString((string)($this->payload['applicant_postal_code'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantCity
	 */
	public function rgaApplicantCity(): Rga\ApplicantCity
	{
		return Rga\ApplicantCity::fromString((string)($this->payload['applicant_city'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantCountryCode
	 */
	public function rgaApplicantCountryCode(): Rga\ApplicantCountryCode
	{
		return Rga\ApplicantCountryCode::fromString((string)($this->payload['applicant_country_code'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantBankAccountNumber
	 */
	public function rgaApplicantBankAccountNumber(): Rga\ApplicantBankAccountNumber
	{
		return Rga\ApplicantBankAccountNumber::fromString((string)($this->payload['applicant_bank_account_number'] ?? ''));
	}
	
	/**
	 * @return Rga\ApplicantBankName
	 */
	public function rgaApplicantBankName(): Rga\ApplicantBankName
	{
		return Rga\ApplicantBankName::fromString((string)($this->payload['applicant_bank_name'] ?? ''));
	}
	
	/**
	 * @return ValueObject\AdminNotes
	 */
	public function rgaAdminNotes(): ValueObject\AdminNotes
	{
		return ValueObject\AdminNotes::fromString((string)($this->payload['admin_notes'] ?? ''));
	}
	
	/**
	 * @param AggregateRoot|Rga $rga
	 */
	public function populate(AggregateRoot $rga): void
	{
		$rga->setApplicantContactPreference($this->rgaApplicantContactPreference());
		$rga->setApplicantEmail($this->rgaApplicantEmail());
		$rga->setApplicantTelephone($this->rgaApplicantTelephone());
		
		$rga->setApplicantFullName($this->rgaApplicantFullName());
		$rga->setApplicantStreetName($this->rgaApplicantStreetName());
		$rga->setApplicantBuildingNumber($this->rgaApplicantBuildingNumber());
		$rga->setApplicantApartmentNumber($this->rgaApplicantApartmentNumber());
		$rga->setApplicantPostalCode($this->rgaApplicantPostalCode());
		$rga->setApplicantCity($this->rgaApplicantCity());
		$rga->setApplicantCountryCode($this->rgaApplicantCountryCode());
		
		$rga->setApplicantBankAccountNumber($this->rgaApplicantBankAccountNumber());
		$rga->setApplicantBankName($this->rgaApplicantBankName());
	}
}