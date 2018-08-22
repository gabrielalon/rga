<?php

namespace RGA\Domain\Validation\Base;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Model;
use RGA\Domain\Validation\Base\Constraint as BaseConstraint;
use RGA\Domain\Validation\Behaviour\Constraint as BehaviourConstraint;
use RGA\Domain\Validation\State\Constraint as StateConstraint;
use RGA\Domain\Validation\Transport\Constraint as TransportConstraint;
use RGA\Domain\Validation\Uuid\Constraint as UuidConstraint;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\Source\Warranty;

class RgaValidationRules
	extends ValidationRules
{
	/** @var Model\Base\Rga */
	private $rga;
	
	/** @var Model\Source\RgaObject */
	private $object;
	
	/** @var Warranty\ConfigInterface */
	private $config;
	
	/** @var Persist\Behaviour\BehaviourRepositoryInterface */
	private $behaviourRepository;
	
	/** @var Persist\State\StateRepositoryInterface */
	private $stateRepository;
	
	/** @var Persist\Transport\TransportRepositoryInterface */
	private $transportRepository;
	
	/**
	 * @param Model\Base\Rga $rga
	 * @param Model\Source\RgaObject $object
	 * @param Warranty\ConfigInterface $config
	 * @param Persist\Behaviour\BehaviourRepositoryInterface $behaviourRepository
	 * @param Persist\State\StateRepositoryInterface $stateRepository
	 * @param Persist\Transport\TransportRepositoryInterface $transportRepository
	 */
	public function __construct(
		Model\Base\Rga $rga,
		Model\Source\RgaObject $object,
		Warranty\ConfigInterface $config,
		Persist\Behaviour\BehaviourRepositoryInterface $behaviourRepository,
		Persist\State\StateRepositoryInterface $stateRepository,
		Persist\Transport\TransportRepositoryInterface $transportRepository
	)
	{
		$this->rga = $rga;
		$this->object = $object;
		$this->config = $config;
		$this->behaviourRepository = $behaviourRepository;
		$this->stateRepository = $stateRepository;
		$this->transportRepository = $transportRepository;
	}
	
	private function getRgaBehaviourType()
	{
		try
		{
			$behaviour = $this->behaviourRepository->find($this->rga->getBehaviourUuid());
			
			return $behaviour->getType();
		}
		catch (Persist\Exception\NotFound $e)
		{
			return 'uknown';
		}
	}
	
	public function getRules()
	{
		return [
			['uuid', new UuidConstraint\Uuid()],
			
			['behaviourUuid', new UuidConstraint\Uuid()],
			['behaviourUuid', new BehaviourConstraint\Exist($this->behaviourRepository)],
			
			['stateUuid', new UuidConstraint\Uuid()],
			['stateUuid', new StateConstraint\Exist($this->stateRepository)],
			
			['transportUuid', new UuidConstraint\Uuid()],
			['transportUuid', new TransportConstraint\Exist($this->transportRepository)],
			
			['sourceObjectType', new BaseConstraint\SourceObjectTypeConcern()],
			['sourceObjectID', new BaseConstraint\ConditionIsMetConcern($this->object, $this->getRgaBehaviourType(), $this->config)],
			['sourceObjectItemID', new BaseConstraint\ConditionIsMetConcern($this->object, $this->getRgaBehaviourType(), $this->config)],
			
			['applicantGivenSourceObjectID', new Constraint\NonEmpty()],
			['applicantGivenSourceObjectID', new Constraint\MinLength(1)],
			['applicantGivenSourceObjectID', new Constraint\MaxLength(255)],
			
			['applicantGivenSourceIdentification', new Constraint\NonEmpty()],
			['applicantGivenSourceIdentification', new Constraint\MinLength(1)],
			['applicantGivenSourceIdentification', new Constraint\MaxLength(255)],
			
			['applicantGivenProductName', new Constraint\NonEmpty()],
			['applicantGivenProductName', new Constraint\MinLength(1)],
			['applicantGivenProductName', new Constraint\MaxLength(255)],
			
			['applicantReasons', new Constraint\NonEmpty()],
			['applicantReasons', new Constraint\MaxLength(65535)],
			
			['applicantExpectations', new Constraint\NonEmpty()],
			['applicantExpectations', new Constraint\MaxLength(65535)],
			
			['applicantDescriptionOfIncident', new Constraint\MaxLength(65535)],
			['applicantContactPreference', new Constraint\MaxLength(65535)],
			
			['applicantObjectType', new BaseConstraint\Ownership($this->rga, $this->object)],
			['applicantObjectID', new BaseConstraint\Ownership($this->rga, $this->object)],
			
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
			
			['individualNumber', new Constraint\Integer()],
			['individualGroup', new Constraint\Integer()]
		];
	}
}