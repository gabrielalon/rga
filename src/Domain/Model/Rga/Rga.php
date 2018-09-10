<?php

namespace RGA\Domain\Model\Rga;

use RGA\Domain\Model\Source;
use RGA\Domain\Model\Rga\Event;
use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Rga
	extends Aggregate\AggregateRoot
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\CreatedAt */
	private $createdAt;
	
	/** @var ValueObject\BehaviourUuid */
	private $behaviourUuid;
	
	/** @var ValueObject\StateUuid */
	private $stateUuid;
	
	/** @var ValueObject\TransportUuid */
	private $transportUuid;
	
	/** @var ValueObject\SourceObjectType */
	private $sourceObjectType;
	
	/** @var ValueObject\SourceObjectId */
	private $sourceObjectId;
	
	/** @var ValueObject\SourceObjectItemId */
	private $sourceObjectItemId;
	
	/** @var ValueObject\SourceDateOfCreation */
	private $sourceDateOfCreation;
	
	/** @var ValueObject\ProductName */
	private $productName;
	
	/** @var ValueObject\ProductVariantId */
	private $productVariantId;
	
	/** @var ValueObject\ApplicantGivenSourceObjectId */
	private $applicantGivenSourceObjectId;
	
	/** @var ValueObject\ApplicantGivenSourceIdentification */
	private $applicantGivenSourceIdentification;
	
	/** @var ValueObject\ApplicantGivenProductName */
	private $applicantGivenProductName;
	
	/** @var ValueObject\ApplicantReasons */
	private $applicantReasons;
	
	/** @var ValueObject\ApplicantExpectations */
	private $applicantExpectations;
	
	/** @var ValueObject\ApplicantDescriptionOfIncident */
	private $applicantDescriptionOfIncident;
	
	/** @var ValueObject\ApplicantContactPreference */
	private $applicantContactPreference;
	
	/** @var ValueObject\ApplicantObjectType */
	private $applicantObjectType;
	
	/** @var ValueObject\ApplicantObjectId */
	private $applicantObjectId;
	
	/** @var ValueObject\ApplicantEmail */
	private $applicantEmail;
	
	/** @var ValueObject\ApplicantTelephone */
	private $applicantTelephone;
	
	/** @var ValueObject\ApplicantFullName */
	private $applicantFullName;
	
	/** @var ValueObject\ApplicantStreetName */
	private $applicantStreetName;
	
	/** @var ValueObject\ApplicantBuildingNumber */
	private $applicantBuildingNumber;
	
	/** @var ValueObject\ApplicantApartmentNumber */
	private $applicantApartmentNumber;
	
	/** @var ValueObject\ApplicantPostalCode */
	private $applicantPostalCode;
	
	/** @var ValueObject\ApplicantCity */
	private $applicantCity;
	
	/** @var ValueObject\ApplicantCountryCode */
	private $applicantCountryCode;
	
	/** @var ValueObject\ApplicantBankAccountNumber */
	private $applicantBankAccountNumber;
	
	/** @var ValueObject\ApplicantBankName */
	private $applicantBankName;
	
	/** @var ValueObject\AdminNotes */
	private $adminNotes;
	
	/** @var ValueObject\AdminNotesForApplicant */
	private $adminNotesForApplicant;
	
	/** @var ValueObject\IsProductReceived */
	private $isProductReceived;
	
	/** @var ValueObject\IsCashReturned */
	private $isCashReturned;
	
	/** @var ValueObject\IsProductReturned */
	private $isProductReturned;
	
	/** @var ValueObject\IsDeleted */
	private $isDeleted;
	
	/** @var ValueObject\PackageSent */
	private $packageSent;
	
	/** @var ValueObject\PackageNo */
	private $packageNo;
	
	/** @var ValueObject\PackageSentAt */
	private $packageSentAt;
	
	/**
	 * @param Rga\Uuid $uuid
	 */
	public function setUuid(Rga\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param Rga\CreatedAt $createdAt
	 */
	public function setCreatedAt(Rga\CreatedAt $createdAt): void
	{
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @param Rga\BehaviourUuid $behaviourUuid
	 */
	public function setBehaviourUuid(Rga\BehaviourUuid $behaviourUuid): void
	{
		$this->behaviourUuid = $behaviourUuid;
	}
	
	/**
	 * @param Rga\StateUuid $stateUuid
	 */
	public function setStateUuid(Rga\StateUuid $stateUuid): void
	{
		$this->stateUuid = $stateUuid;
	}
	
	/**
	 * @param Rga\TransportUuid $transportUuid
	 */
	public function setTransportUuid(Rga\TransportUuid $transportUuid): void
	{
		$this->transportUuid = $transportUuid;
	}
	
	/**
	 * @param Rga\SourceObjectType $sourceObjectType
	 */
	public function setSourceObjectType(Rga\SourceObjectType $sourceObjectType): void
	{
		$this->sourceObjectType = $sourceObjectType;
	}
	
	/**
	 * @param Rga\SourceObjectId $sourceObjectId
	 */
	public function setSourceObjectId(Rga\SourceObjectId $sourceObjectId): void
	{
		$this->sourceObjectId = $sourceObjectId;
	}
	
	/**
	 * @param Rga\SourceObjectItemId $sourceObjectItemId
	 */
	public function setSourceObjectItemId(Rga\SourceObjectItemId $sourceObjectItemId): void
	{
		$this->sourceObjectItemId = $sourceObjectItemId;
	}
	
	/**
	 * @param Rga\SourceDateOfCreation $sourceDateOfCreation
	 */
	public function setSourceDateOfCreation(Rga\SourceDateOfCreation $sourceDateOfCreation): void
	{
		$this->sourceDateOfCreation = $sourceDateOfCreation;
	}
	
	/**
	 * @param Rga\ProductName $productName
	 */
	public function setProductName(Rga\ProductName $productName): void
	{
		$this->productName = $productName;
	}
	
	/**
	 * @param Rga\ProductVariantId $productVariantId
	 */
	public function setProductVariantId(Rga\ProductVariantId $productVariantId): void
	{
		$this->productVariantId = $productVariantId;
	}
	
	/**
	 * @param Rga\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId
	 */
	public function setApplicantGivenSourceObjectId(Rga\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId): void
	{
		$this->applicantGivenSourceObjectId = $applicantGivenSourceObjectId;
	}
	
	/**
	 * @param Rga\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification
	 */
	public function setApplicantGivenSourceIdentification(Rga\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification): void
	{
		$this->applicantGivenSourceIdentification = $applicantGivenSourceIdentification;
	}
	
	/**
	 * @param Rga\ApplicantGivenProductName $applicantGivenProductName
	 */
	public function setApplicantGivenProductName(Rga\ApplicantGivenProductName $applicantGivenProductName): void
	{
		$this->applicantGivenProductName = $applicantGivenProductName;
	}
	
	/**
	 * @param Rga\ApplicantReasons $applicantReasons
	 */
	public function setApplicantReasons(Rga\ApplicantReasons $applicantReasons): void
	{
		$this->applicantReasons = $applicantReasons;
	}
	
	/**
	 * @param Rga\ApplicantExpectations $applicantExpectations
	 */
	public function setApplicantExpectations(Rga\ApplicantExpectations $applicantExpectations): void
	{
		$this->applicantExpectations = $applicantExpectations;
	}
	
	/**
	 * @param Rga\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident
	 */
	public function setApplicantDescriptionOfIncident(Rga\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident): void
	{
		$this->applicantDescriptionOfIncident = $applicantDescriptionOfIncident;
	}
	
	/**
	 * @param Rga\ApplicantContactPreference $applicantContactPreference
	 */
	public function setApplicantContactPreference(Rga\ApplicantContactPreference $applicantContactPreference): void
	{
		$this->applicantContactPreference = $applicantContactPreference;
	}
	
	/**
	 * @param Rga\ApplicantObjectType $applicantObjectType
	 */
	public function setApplicantObjectType(Rga\ApplicantObjectType $applicantObjectType): void
	{
		$this->applicantObjectType = $applicantObjectType;
	}
	
	/**
	 * @param Rga\ApplicantObjectId $applicantObjectId
	 */
	public function setApplicantObjectId(Rga\ApplicantObjectId $applicantObjectId): void
	{
		$this->applicantObjectId = $applicantObjectId;
	}
	
	/**
	 * @param Rga\ApplicantEmail $applicantEmail
	 */
	public function setApplicantEmail(Rga\ApplicantEmail $applicantEmail): void
	{
		$this->applicantEmail = $applicantEmail;
	}
	
	/**
	 * @param Rga\ApplicantTelephone $applicantTelephone
	 */
	public function setApplicantTelephone(Rga\ApplicantTelephone $applicantTelephone): void
	{
		$this->applicantTelephone = $applicantTelephone;
	}
	
	/**
	 * @param Rga\ApplicantFullName $applicantFullName
	 */
	public function setApplicantFullName(Rga\ApplicantFullName $applicantFullName): void
	{
		$this->applicantFullName = $applicantFullName;
	}
	
	/**
	 * @param Rga\ApplicantStreetName $applicantStreetName
	 */
	public function setApplicantStreetName(Rga\ApplicantStreetName $applicantStreetName): void
	{
		$this->applicantStreetName = $applicantStreetName;
	}
	
	/**
	 * @param Rga\ApplicantBuildingNumber $applicantBuildingNumber
	 */
	public function setApplicantBuildingNumber(Rga\ApplicantBuildingNumber $applicantBuildingNumber): void
	{
		$this->applicantBuildingNumber = $applicantBuildingNumber;
	}
	
	/**
	 * @param Rga\ApplicantApartmentNumber $applicantApartmentNumber
	 */
	public function setApplicantApartmentNumber(Rga\ApplicantApartmentNumber $applicantApartmentNumber): void
	{
		$this->applicantApartmentNumber = $applicantApartmentNumber;
	}
	
	/**
	 * @param Rga\ApplicantPostalCode $applicantPostalCode
	 */
	public function setApplicantPostalCode(Rga\ApplicantPostalCode $applicantPostalCode): void
	{
		$this->applicantPostalCode = $applicantPostalCode;
	}
	
	/**
	 * @param Rga\ApplicantCity $applicantCity
	 */
	public function setApplicantCity(Rga\ApplicantCity $applicantCity): void
	{
		$this->applicantCity = $applicantCity;
	}
	
	/**
	 * @param Rga\ApplicantCountryCode $applicantCountryCode
	 */
	public function setApplicantCountryCode(Rga\ApplicantCountryCode $applicantCountryCode): void
	{
		$this->applicantCountryCode = $applicantCountryCode;
	}
	
	/**
	 * @param Rga\ApplicantBankAccountNumber $applicantBankAccountNumber
	 */
	public function setApplicantBankAccountNumber(Rga\ApplicantBankAccountNumber $applicantBankAccountNumber): void
	{
		$this->applicantBankAccountNumber = $applicantBankAccountNumber;
	}
	
	/**
	 * @param Rga\ApplicantBankName $applicantBankName
	 */
	public function setApplicantBankName(Rga\ApplicantBankName $applicantBankName): void
	{
		$this->applicantBankName = $applicantBankName;
	}
	
	/**
	 * @param Rga\AdminNotes $adminNotes
	 */
	public function setAdminNotes(Rga\AdminNotes $adminNotes): void
	{
		$this->adminNotes = $adminNotes;
	}
	
	/**
	 * @param Rga\AdminNotesForApplicant $adminNotesForApplicant
	 */
	public function setAdminNotesForApplicant(Rga\AdminNotesForApplicant $adminNotesForApplicant): void
	{
		$this->adminNotesForApplicant = $adminNotesForApplicant;
	}
	
	/**
	 * @param Rga\IsProductReceived $isProductReceived
	 */
	public function setIsProductReceived(Rga\IsProductReceived $isProductReceived): void
	{
		$this->isProductReceived = $isProductReceived;
	}
	
	/**
	 * @param Rga\IsCashReturned $isCashReturned
	 */
	public function setIsCashReturned(Rga\IsCashReturned $isCashReturned): void
	{
		$this->isCashReturned = $isCashReturned;
	}
	
	/**
	 * @param Rga\IsProductReturned $isProductReturned
	 */
	public function setIsProductReturned(Rga\IsProductReturned $isProductReturned): void
	{
		$this->isProductReturned = $isProductReturned;
	}
	
	/**
	 * @param Rga\IsDeleted $isDeleted
	 */
	public function setIsDeleted(Rga\IsDeleted $isDeleted): void
	{
		$this->isDeleted = $isDeleted;
	}
	
	/**
	 * @param Rga\PackageSent $packageSent
	 */
	public function setPackageSent(Rga\PackageSent $packageSent): void
	{
		$this->packageSent = $packageSent;
	}
	
	/**
	 * @param Rga\PackageNo $packageNo
	 */
	public function setPackageNo(Rga\PackageNo $packageNo): void
	{
		$this->packageNo = $packageNo;
	}
	
	/**
	 * @param Rga\PackageSentAt $packageSentAt
	 */
	public function setPackageSentAt(Rga\PackageSentAt $packageSentAt): void
	{
		$this->packageSentAt = $packageSentAt;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
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
		ValueObject\PackageNo $packageNo,
		ValueObject\PackageSentAt $packageSentAt
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
	public function stateRgaChanged(ValueObject\StateUuid $stateUuid): void
	{
		$this->recordThat(Event\StateRgaChanged::occur($this->aggregateId(), [
			'state_uuid' => $stateUuid->toString()
		]));
	}
	
	/**
	 * @param Rga\AdminNotes $adminNotes
	 */
	public function noteRgaChanged(ValueObject\AdminNotes $adminNotes): void
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
		ValueObject\AdminNotesForApplicant $notes,
		ValueObject\IsProductReceived $productReceived,
		ValueObject\IsCashReturned $cashReturned,
		ValueObject\IsProductReturned $productReturned
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