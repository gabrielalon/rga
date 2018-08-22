<?php

namespace RGA\Domain\Validation\Base;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Base\Constraint as BaseConstraint;

class RgaApplicantValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['applicantEmail', new Constraint\Email()],
			
			['applicantTelephone', new BaseConstraint\TelephoneConcern()],
			
			['applicantFullName', new Constraint\NonEmpty()],
			['applicantFullName', new Constraint\MinLength(1)],
			['applicantFullName', new Constraint\MaxLength(255)],
			
			['applicantStreetName', new Constraint\NonEmpty()],
			['applicantStreetName', new Constraint\MinLength(1)],
			['applicantStreetName', new Constraint\MaxLength(255)],
			
			['applicantBuildingNumber', new Constraint\NonEmpty()],
			['applicantBuildingNumber', new Constraint\MinLength(1)],
			['applicantBuildingNumber', new Constraint\MaxLength(10)],
			
			['applicantApartmentNumber', new Constraint\MaxLength(10)],
			
			['applicantPostalCode', new Constraint\NonEmpty()],
			['applicantPostalCode', new Constraint\MinLength(1)],
			['applicantPostalCode', new Constraint\MaxLength(10)],
			['applicantPostalCode', new BaseConstraint\PostalCodeConcern()],
			
			['applicantCity', new Constraint\NonEmpty()],
			['applicantCity', new Constraint\MinLength(1)],
			['applicantCity', new Constraint\MaxLength(255)],
			
			['applicantCountryCode', new Constraint\NonEmpty()],
			['applicantCountryCode', new Constraint\MinLength(2)],
			['applicantCountryCode', new Constraint\MaxLength(2)],
			['applicantCountryCode', new Constraint\Regexp('/^[a-zA-Z]{2}$/', 'invalid_country_code')],
			
			['applicantBankAccountNumber', new Constraint\MaxLength(255)],
			['applicantBankAccountNumber', new Constraint\Regexp('/^$|((?:[a-zA-Z]{2})?[0-9]{2}[a-zA-Z0-9]{4}[0-9]{7}(?:[a-zA-Z0-9]?){0,16})/', 'invalid_bank_account_number')],
			
			['applicantBankName', new Constraint\MaxLength(255)],
		];
	}
}