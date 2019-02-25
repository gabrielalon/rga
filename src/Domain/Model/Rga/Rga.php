<?php

namespace RGA\Domain\Model\Rga;

use RGA\Application\Rga\Event;
use RGA\Application\Rga\Integration;
use RGA\Domain\Model\Source;
use RGA\Domain\Model\Rga\Rga as VO;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Rga
	extends Aggregate\AggregateRoot
{
	/** @var VO\Uuid */
	protected $uuid;
	
	/** @var VO\CreatedAt */
	protected $createdAt;
	
	/** @var VO\BehaviourUuid */
	protected $behaviourUuid;
	
	/** @var VO\StateUuid */
	protected $stateUuid;
	
	/** @var VO\TransportUuid */
	protected $transportUuid;
	
	/** @var VO\SourceObjectType */
	protected $sourceObjectType;
	
	/** @var VO\SourceObjectId */
	protected $sourceObjectId;
	
	/** @var VO\SourceObjectItemId */
	protected $sourceObjectItemId;
	
	/** @var VO\SourceDateOfCreation */
	protected $sourceDateOfCreation;
	
	/** @var VO\ProductName */
	protected $productName;
	
	/** @var VO\ProductVariantId */
	protected $productVariantId;
	
	/** @var VO\ApplicantGivenSourceObjectId */
	protected $applicantGivenSourceObjectId;
	
	/** @var VO\ApplicantGivenSourceIdentification */
	protected $applicantGivenSourceIdentification;
	
	/** @var VO\ApplicantGivenProductName */
	protected $applicantGivenProductName;
	
	/** @var VO\ApplicantReasons */
	protected $applicantReasons;
	
	/** @var VO\ApplicantExpectations */
	protected $applicantExpectations;
	
	/** @var VO\ApplicantDescriptionOfIncident */
	protected $applicantDescriptionOfIncident;
	
	/** @var VO\ApplicantContactPreference */
	protected $applicantContactPreference;
	
	/** @var VO\ApplicantObjectType */
	protected $applicantObjectType;
	
	/** @var VO\ApplicantObjectId */
	protected $applicantObjectId;
	
	/** @var VO\ApplicantEmail */
	protected $applicantEmail;
	
	/** @var VO\ApplicantTelephone */
	protected $applicantTelephone;
	
	/** @var VO\ApplicantFullName */
	protected $applicantFullName;
	
	/** @var VO\ApplicantStreetName */
	protected $applicantStreetName;
	
	/** @var VO\ApplicantBuildingNumber */
	protected $applicantBuildingNumber;
	
	/** @var VO\ApplicantApartmentNumber */
	protected $applicantApartmentNumber;
	
	/** @var VO\ApplicantPostalCode */
	protected $applicantPostalCode;
	
	/** @var VO\ApplicantCity */
	protected $applicantCity;
	
	/** @var VO\ApplicantCountryCode */
	protected $applicantCountryCode;
	
	/** @var VO\ApplicantBankAccountNumber */
	protected $applicantBankAccountNumber;
	
	/** @var VO\ApplicantBankName */
	protected $applicantBankName;
	
	/** @var VO\AdminNotes */
	protected $adminNotes;
	
	/** @var VO\AdminNotesForApplicant */
	protected $adminNotesForApplicant;
	
	/** @var VO\IsProductReceived */
	protected $isProductReceived;
	
	/** @var VO\IsCashReturned */
	protected $isCashReturned;
	
	/** @var VO\IsProductReturned */
	protected $isProductReturned;
	
	/** @var VO\IsDeleted */
	protected $isDeleted;
	
	/** @var VO\PackageSent */
	protected $packageSent;
	
	/** @var VO\PackageNo */
	protected $packageNo;
	
	/** @var VO\PackageSentAt */
	protected $packageSentAt;
	
	/**
	 * @param Rga\Uuid $uuid
	 * @return Rga
	 */
	public function setUuid(Rga\Uuid $uuid): Rga
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @param Rga\CreatedAt $createdAt
	 * @return Rga
	 */
	public function setCreatedAt(Rga\CreatedAt $createdAt): Rga
	{
		$this->createdAt = $createdAt;
		
		return $this;
	}
	
	/**
	 * @param Rga\BehaviourUuid $behaviourUuid
	 * @return Rga
	 */
	public function setBehaviourUuid(Rga\BehaviourUuid $behaviourUuid): Rga
	{
		$this->behaviourUuid = $behaviourUuid;
		
		return $this;
	}
	
	/**
	 * @param Rga\StateUuid $stateUuid
	 * @return Rga
	 */
	public function setStateUuid(Rga\StateUuid $stateUuid): Rga
	{
		$this->stateUuid = $stateUuid;
		
		return $this;
	}
	
	/**
	 * @param Rga\TransportUuid $transportUuid
	 * @return Rga
	 */
	public function setTransportUuid(Rga\TransportUuid $transportUuid): Rga
	{
		$this->transportUuid = $transportUuid;
		
		return $this;
	}
	
	/**
	 * @param Rga\SourceObjectType $sourceObjectType
	 * @return Rga
	 */
	public function setSourceObjectType(Rga\SourceObjectType $sourceObjectType): Rga
	{
		$this->sourceObjectType = $sourceObjectType;
		
		return $this;
	}
	
	/**
	 * @param Rga\SourceObjectId $sourceObjectId
	 * @return Rga
	 */
	public function setSourceObjectId(Rga\SourceObjectId $sourceObjectId): Rga
	{
		$this->sourceObjectId = $sourceObjectId;
		
		return $this;
	}
	
	/**
	 * @param Rga\SourceObjectItemId $sourceObjectItemId
	 * @return Rga
	 */
	public function setSourceObjectItemId(Rga\SourceObjectItemId $sourceObjectItemId): Rga
	{
		$this->sourceObjectItemId = $sourceObjectItemId;
		
		return $this;
	}
	
	/**
	 * @param Rga\SourceDateOfCreation $sourceDateOfCreation
	 * @return Rga
	 */
	public function setSourceDateOfCreation(Rga\SourceDateOfCreation $sourceDateOfCreation): Rga
	{
		$this->sourceDateOfCreation = $sourceDateOfCreation;
		
		return $this;
	}
	
	/**
	 * @param Rga\ProductName $productName
	 * @return Rga
	 */
	public function setProductName(Rga\ProductName $productName): Rga
	{
		$this->productName = $productName;
		
		return $this;
	}
	
	/**
	 * @param Rga\ProductVariantId $productVariantId
	 * @return Rga
	 */
	public function setProductVariantId(Rga\ProductVariantId $productVariantId): Rga
	{
		$this->productVariantId = $productVariantId;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId
	 * @return Rga
	 */
	public function setApplicantGivenSourceObjectId(Rga\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId): Rga
	{
		$this->applicantGivenSourceObjectId = $applicantGivenSourceObjectId;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification
	 * @return Rga
	 */
	public function setApplicantGivenSourceIdentification(Rga\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification): Rga
	{
		$this->applicantGivenSourceIdentification = $applicantGivenSourceIdentification;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantGivenProductName $applicantGivenProductName
	 * @return Rga
	 */
	public function setApplicantGivenProductName(Rga\ApplicantGivenProductName $applicantGivenProductName): Rga
	{
		$this->applicantGivenProductName = $applicantGivenProductName;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantReasons $applicantReasons
	 * @return Rga
	 */
	public function setApplicantReasons(Rga\ApplicantReasons $applicantReasons): Rga
	{
		$this->applicantReasons = $applicantReasons;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantExpectations $applicantExpectations
	 * @return Rga
	 */
	public function setApplicantExpectations(Rga\ApplicantExpectations $applicantExpectations): Rga
	{
		$this->applicantExpectations = $applicantExpectations;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident
	 * @return Rga
	 */
	public function setApplicantDescriptionOfIncident(Rga\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident): Rga
	{
		$this->applicantDescriptionOfIncident = $applicantDescriptionOfIncident;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantContactPreference $applicantContactPreference
	 * @return Rga
	 */
	public function setApplicantContactPreference(Rga\ApplicantContactPreference $applicantContactPreference): Rga
	{
		$this->applicantContactPreference = $applicantContactPreference;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantObjectType $applicantObjectType
	 * @return Rga
	 */
	public function setApplicantObjectType(Rga\ApplicantObjectType $applicantObjectType): Rga
	{
		$this->applicantObjectType = $applicantObjectType;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantObjectId $applicantObjectId
	 * @return Rga
	 */
	public function setApplicantObjectId(Rga\ApplicantObjectId $applicantObjectId): Rga
	{
		$this->applicantObjectId = $applicantObjectId;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantEmail $applicantEmail
	 * @return Rga
	 */
	public function setApplicantEmail(Rga\ApplicantEmail $applicantEmail): Rga
	{
		$this->applicantEmail = $applicantEmail;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantTelephone $applicantTelephone
	 * @return Rga
	 */
	public function setApplicantTelephone(Rga\ApplicantTelephone $applicantTelephone): Rga
	{
		$this->applicantTelephone = $applicantTelephone;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantFullName $applicantFullName
	 * @return Rga
	 */
	public function setApplicantFullName(Rga\ApplicantFullName $applicantFullName): Rga
	{
		$this->applicantFullName = $applicantFullName;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantStreetName $applicantStreetName
	 * @return Rga
	 */
	public function setApplicantStreetName(Rga\ApplicantStreetName $applicantStreetName): Rga
	{
		$this->applicantStreetName = $applicantStreetName;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantBuildingNumber $applicantBuildingNumber
	 * @return Rga
	 */
	public function setApplicantBuildingNumber(Rga\ApplicantBuildingNumber $applicantBuildingNumber): Rga
	{
		$this->applicantBuildingNumber = $applicantBuildingNumber;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantApartmentNumber $applicantApartmentNumber
	 * @return Rga
	 */
	public function setApplicantApartmentNumber(Rga\ApplicantApartmentNumber $applicantApartmentNumber): Rga
	{
		$this->applicantApartmentNumber = $applicantApartmentNumber;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantPostalCode $applicantPostalCode
	 * @return Rga
	 */
	public function setApplicantPostalCode(Rga\ApplicantPostalCode $applicantPostalCode): Rga
	{
		$this->applicantPostalCode = $applicantPostalCode;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantCity $applicantCity
	 * @return Rga
	 */
	public function setApplicantCity(Rga\ApplicantCity $applicantCity): Rga
	{
		$this->applicantCity = $applicantCity;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantCountryCode $applicantCountryCode
	 * @return Rga
	 */
	public function setApplicantCountryCode(Rga\ApplicantCountryCode $applicantCountryCode): Rga
	{
		$this->applicantCountryCode = $applicantCountryCode;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantBankAccountNumber $applicantBankAccountNumber
	 * @return Rga
	 */
	public function setApplicantBankAccountNumber(Rga\ApplicantBankAccountNumber $applicantBankAccountNumber): Rga
	{
		$this->applicantBankAccountNumber = $applicantBankAccountNumber;
		
		return $this;
	}
	
	/**
	 * @param Rga\ApplicantBankName $applicantBankName
	 * @return Rga
	 */
	public function setApplicantBankName(Rga\ApplicantBankName $applicantBankName): Rga
	{
		$this->applicantBankName = $applicantBankName;
		
		return $this;
	}
	
	/**
	 * @param Rga\AdminNotes $adminNotes
	 * @return Rga
	 */
	public function setAdminNotes(Rga\AdminNotes $adminNotes): Rga
	{
		$this->adminNotes = $adminNotes;
		
		return $this;
	}
	
	/**
	 * @param Rga\AdminNotesForApplicant $adminNotesForApplicant
	 * @return Rga
	 */
	public function setAdminNotesForApplicant(Rga\AdminNotesForApplicant $adminNotesForApplicant): Rga
	{
		$this->adminNotesForApplicant = $adminNotesForApplicant;
		
		return $this;
	}
	
	/**
	 * @param Rga\IsProductReceived $isProductReceived
	 * @return Rga
	 */
	public function setIsProductReceived(Rga\IsProductReceived $isProductReceived): Rga
	{
		$this->isProductReceived = $isProductReceived;
		
		return $this;
	}
	
	/**
	 * @param Rga\IsCashReturned $isCashReturned
	 * @return Rga
	 */
	public function setIsCashReturned(Rga\IsCashReturned $isCashReturned): Rga
	{
		$this->isCashReturned = $isCashReturned;
		
		return $this;
	}
	
	/**
	 * @param Rga\IsProductReturned $isProductReturned
	 * @return Rga
	 */
	public function setIsProductReturned(Rga\IsProductReturned $isProductReturned): Rga
	{
		$this->isProductReturned = $isProductReturned;
		
		return $this;
	}
	
	/**
	 * @param Rga\IsDeleted $isDeleted
	 * @return Rga
	 */
	public function setIsDeleted(Rga\IsDeleted $isDeleted): Rga
	{
		$this->isDeleted = $isDeleted;
		
		return $this;
	}
	
	/**
	 * @param Rga\PackageSent $packageSent
	 * @return Rga
	 */
	public function setPackageSent(Rga\PackageSent $packageSent): Rga
	{
		$this->packageSent = $packageSent;
		
		return $this;
	}
	
	/**
	 * @param Rga\PackageNo $packageNo
	 * @return Rga
	 */
	public function setPackageNo(Rga\PackageNo $packageNo): Rga
	{
		$this->packageNo = $packageNo;
		
		return $this;
	}
	
	/**
	 * @param Rga\PackageSentAt $packageSentAt
	 * @return Rga
	 */
	public function setPackageSentAt(Rga\PackageSentAt $packageSentAt): Rga
	{
		$this->packageSentAt = $packageSentAt;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setAggregateId($id): void
	{
		$this->setUuid(VO\Uuid::fromString($id));
	}
	
	/**
	 * @param Rga\Uuid $uuid
	 * @param Rga\Reference\References $references
	 * @param Rga\Given\Item $item
	 * @param Rga\Applicant\Applicant $applicant
	 * @param Rga\Applicant\Address $address
	 * @param Rga\Applicant\Contact $contact
	 * @param Rga\Applicant\Bank $bank
	 * @param Source\RgaObject $source
	 * @param Integration\Warranty\Calculator $warrantyCalculator
	 * @return Rga
	 */
	public static function createNewRga(
		Rga\Uuid $uuid,
		Rga\Reference\References $references,
		Rga\Given\Item $item,
		Rga\Applicant\Applicant $applicant,
		Rga\Applicant\Address $address,
		Rga\Applicant\Contact $contact,
		Rga\Applicant\Bank $bank,
		Source\RgaObject $source,
		Integration\Warranty\Calculator $warrantyCalculator
	): Rga
	{
		$rga = new Rga();
		
		$warrantyCalculator->setCreationDate($source->getCreatedAt());
		
		Source\Condition\Condition\IsObjectReady::assert($source);
		Source\Condition\Ownership\BelongsTo::assert($applicant, $source);
		
		if ($source->getItems()->has($item->getSourceItemID()))
		{
			$sourceItem = $source->getItems()->get($item->getSourceItemID());
			Source\Condition\Condition\IsObjectItemReady::assert($references->getBehaviourType(), $sourceItem, $warrantyCalculator);
		}
		else
		{
			$sourceItem = $item;
		}
		
		$rga->recordThat(Event\NewRgaCreated::occur($uuid->toString(), [
			'created_at' => \date('Y-m-d H:i:s'),
			
			'behaviour_uuid' => $references->getBehaviourUuid(),
			'state_uuid' => $references->getStateUuid(),
			'transport_uuid' => $references->getTransportUuid(),
			
			'source_object_type' => $source->getType(),
			'source_object_id' => $source->getId(),
			'source_object_item_id' => $sourceItem->getId(),
			'source_date_of_creation' => \date('Y-m-d H:i:s', $source->getCreatedAt()),
			
			'product_name' => $sourceItem->getName(),
			'product_variant_id' => $sourceItem->getVariantId(),
			
			'applicant_given_source_object_id' => $item->getGivenSourceID(),
			'applicant_given_source_identification' => $item->getGivenSourceID(),
			'applicant_given_product_name' => $item->getGivenName(),
			
			'applicant_reasons' => $item->getReason(),
			'applicant_expectations' => $item->getExpectation(),
			'applicant_description_of_incident' => $item->getIncident(),
			
			'applicant_object_type' => $applicant->getType(),
			'applicant_object_id' => $applicant->getId(),
			
			'applicant_contact_preference' => $contact->getPreferredForm(),
			'applicant_email' => $contact->getEmail(),
			'applicant_telephone' => $contact->getTelephone(),
			
			'applicant_full_name' => $address->getFullName(),
			'applicant_street_name' => $address->getStreetName(),
			'applicant_building_number' => $address->getBuildingNumber(),
			'applicant_apartment_number' => $address->getApartmentNumber(),
			'applicant_postal_code' => $address->getPostalCode(),
			'applicant_city' => $address->getCity(),
			'applicant_country_code' => $address->getCountryCode(),
			
			'applicant_bank_account_number' => $bank->getAccountNumber(),
			'applicant_bank_name' => $bank->getName(),
			
			'admin_notes' => '',
			'admin_notes_for_applicant' => '',
			
			'is_product_received' => '0',
			'is_cash_returned' => '0',
			'is_product_returned' => '0',
			'is_deleted' => '0',
			
			'package_sent' => '0',
			'package_no' => '',
			'package_sent_at' => ''
		]));
		
		return $rga;
	}
	
	/**
	 * @param Rga\PackageNo $packageNo
	 * @param Rga\PackageSentAt $packageSentAt
	 */
	public function setPackageRga(
		VO\PackageNo $packageNo,
		VO\PackageSentAt $packageSentAt
	): void
	{
		$this->recordThat(Event\PackageRgaSet::occur($this->aggregateId(), [
			'package_no' => $packageNo->toString(),
			'package_sent_at' => $packageSentAt->toString()
		]));
	}
	
	public function removeRga(): void
	{
		$this->recordThat(Event\ExistingRgaRemoved::occur($this->aggregateId(), [
			'is_deleted' => true
		]));
	}
	
	/**
	 * @param Rga\StateUuid $stateUuid
	 */
	public function stateRgaChanged(VO\StateUuid $stateUuid): void
	{
		$this->recordThat(Event\StateRgaChanged::occur($this->aggregateId(), [
			'state_uuid' => $stateUuid->toString()
		]));
	}
	
	/**
	 * @param Rga\AdminNotes $adminNotes
	 */
	public function noteRgaChanged(VO\AdminNotes $adminNotes): void
	{
		$this->recordThat(Event\NoteRgaChanged::occur($this->aggregateId(), [
			'admin_notes' => $adminNotes->toString()
		]));
	}
	
	/**
	 * @param Rga\AdminNotesForApplicant $notes
	 * @param Rga\IsProductReceived $productReceived
	 * @param Rga\IsCashReturned $cashReturned
	 * @param Rga\IsProductReturned $productReturned
	 */
	public function flagsRgaChanged(
		VO\AdminNotesForApplicant $notes,
		VO\IsProductReceived $productReceived,
		VO\IsCashReturned $cashReturned,
		VO\IsProductReturned $productReturned
	): void
	{
		$this->recordThat(Event\FlagsRgaChanged::occur($this->aggregateId(), [
			'admin_notes_for_applicant' => $notes->toString(),
			
			'is_product_received' => $productReceived->toString(),
			'is_cash_returned' => $cashReturned->toString(),
			'is_product_returned' => $productReturned->toString()
		]));
	}
	
	/**
	 * @param Rga\Applicant\Address $address
	 * @param Rga\Applicant\Contact $contact
	 * @param Rga\Applicant\Bank $bank
	 */
	public function applicantRgaChanged(
		Rga\Applicant\Address $address,
		Rga\Applicant\Contact $contact,
		Rga\Applicant\Bank $bank
	): void
	{
		$this->recordThat(Event\ApplicantRgaChanged::occur($this->aggregateId(), [
			'applicant_contact_preference' => $contact->getPreferredForm(),
			'applicant_email' => $contact->getEmail(),
			'applicant_telephone' => $contact->getTelephone(),
			
			'applicant_full_name' => $address->getFullName(),
			'applicant_street_name' => $address->getStreetName(),
			'applicant_building_number' => $address->getBuildingNumber(),
			'applicant_apartment_number' => $address->getApartmentNumber(),
			'applicant_postal_code' => $address->getPostalCode(),
			'applicant_city' => $address->getCity(),
			'applicant_country_code' => $address->getCountryCode(),
			
			'applicant_bank_account_number' => $bank->getAccountNumber(),
			'applicant_bank_name' => $bank->getName()
		]));
	}
}