<?php

namespace RGA\Test\Mock\Entity\Rga;

use RGA\Domain\Model\Rga\Rga as ValueObject;

class Rga
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
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return Rga
	 */
	public function setUuid(ValueObject\Uuid $uuid): Rga
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\CreatedAt
	 */
	public function getCreatedAt(): ValueObject\CreatedAt
	{
		return $this->createdAt;
	}
	
	/**
	 * @param ValueObject\CreatedAt $createdAt
	 * @return Rga
	 */
	public function setCreatedAt(ValueObject\CreatedAt $createdAt): Rga
	{
		$this->createdAt = $createdAt;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\BehaviourUuid
	 */
	public function getBehaviourUuid(): ValueObject\BehaviourUuid
	{
		return $this->behaviourUuid;
	}
	
	/**
	 * @param ValueObject\BehaviourUuid $behaviourUuid
	 * @return Rga
	 */
	public function setBehaviourUuid(ValueObject\BehaviourUuid $behaviourUuid): Rga
	{
		$this->behaviourUuid = $behaviourUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\StateUuid
	 */
	public function getStateUuid(): ValueObject\StateUuid
	{
		return $this->stateUuid;
	}
	
	/**
	 * @param ValueObject\StateUuid $stateUuid
	 * @return Rga
	 */
	public function setStateUuid(ValueObject\StateUuid $stateUuid): Rga
	{
		$this->stateUuid = $stateUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\TransportUuid
	 */
	public function getTransportUuid(): ValueObject\TransportUuid
	{
		return $this->transportUuid;
	}
	
	/**
	 * @param ValueObject\TransportUuid $transportUuid
	 * @return Rga
	 */
	public function setTransportUuid(ValueObject\TransportUuid $transportUuid): Rga
	{
		$this->transportUuid = $transportUuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\SourceObjectType
	 */
	public function getSourceObjectType(): ValueObject\SourceObjectType
	{
		return $this->sourceObjectType;
	}
	
	/**
	 * @param ValueObject\SourceObjectType $sourceObjectType
	 * @return Rga
	 */
	public function setSourceObjectType(ValueObject\SourceObjectType $sourceObjectType): Rga
	{
		$this->sourceObjectType = $sourceObjectType;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\SourceObjectId
	 */
	public function getSourceObjectId(): ValueObject\SourceObjectId
	{
		return $this->sourceObjectId;
	}
	
	/**
	 * @param ValueObject\SourceObjectId $sourceObjectId
	 * @return Rga
	 */
	public function setSourceObjectId(ValueObject\SourceObjectId $sourceObjectId): Rga
	{
		$this->sourceObjectId = $sourceObjectId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\SourceObjectItemId
	 */
	public function getSourceObjectItemId(): ValueObject\SourceObjectItemId
	{
		return $this->sourceObjectItemId;
	}
	
	/**
	 * @param ValueObject\SourceObjectItemId $sourceObjectItemId
	 * @return Rga
	 */
	public function setSourceObjectItemId(ValueObject\SourceObjectItemId $sourceObjectItemId): Rga
	{
		$this->sourceObjectItemId = $sourceObjectItemId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\SourceDateOfCreation
	 */
	public function getSourceDateOfCreation(): ValueObject\SourceDateOfCreation
	{
		return $this->sourceDateOfCreation;
	}
	
	/**
	 * @param ValueObject\SourceDateOfCreation $sourceDateOfCreation
	 * @return Rga
	 */
	public function setSourceDateOfCreation(ValueObject\SourceDateOfCreation $sourceDateOfCreation): Rga
	{
		$this->sourceDateOfCreation = $sourceDateOfCreation;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ProductName
	 */
	public function getProductName(): ValueObject\ProductName
	{
		return $this->productName;
	}
	
	/**
	 * @param ValueObject\ProductName $productName
	 * @return Rga
	 */
	public function setProductName(ValueObject\ProductName $productName): Rga
	{
		$this->productName = $productName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ProductVariantId
	 */
	public function getProductVariantId(): ValueObject\ProductVariantId
	{
		return $this->productVariantId;
	}
	
	/**
	 * @param ValueObject\ProductVariantId $productVariantId
	 * @return Rga
	 */
	public function setProductVariantId(ValueObject\ProductVariantId $productVariantId): Rga
	{
		$this->productVariantId = $productVariantId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantGivenSourceObjectId
	 */
	public function getApplicantGivenSourceObjectId(): ValueObject\ApplicantGivenSourceObjectId
	{
		return $this->applicantGivenSourceObjectId;
	}
	
	/**
	 * @param ValueObject\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId
	 * @return Rga
	 */
	public function setApplicantGivenSourceObjectId(ValueObject\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId): Rga
	{
		$this->applicantGivenSourceObjectId = $applicantGivenSourceObjectId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantGivenSourceIdentification
	 */
	public function getApplicantGivenSourceIdentification(): ValueObject\ApplicantGivenSourceIdentification
	{
		return $this->applicantGivenSourceIdentification;
	}
	
	/**
	 * @param ValueObject\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification
	 * @return Rga
	 */
	public function setApplicantGivenSourceIdentification(ValueObject\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification): Rga
	{
		$this->applicantGivenSourceIdentification = $applicantGivenSourceIdentification;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantGivenProductName
	 */
	public function getApplicantGivenProductName(): ValueObject\ApplicantGivenProductName
	{
		return $this->applicantGivenProductName;
	}
	
	/**
	 * @param ValueObject\ApplicantGivenProductName $applicantGivenProductName
	 * @return Rga
	 */
	public function setApplicantGivenProductName(ValueObject\ApplicantGivenProductName $applicantGivenProductName): Rga
	{
		$this->applicantGivenProductName = $applicantGivenProductName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantReasons
	 */
	public function getApplicantReasons(): ValueObject\ApplicantReasons
	{
		return $this->applicantReasons;
	}
	
	/**
	 * @param ValueObject\ApplicantReasons $applicantReasons
	 * @return Rga
	 */
	public function setApplicantReasons(ValueObject\ApplicantReasons $applicantReasons): Rga
	{
		$this->applicantReasons = $applicantReasons;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantExpectations
	 */
	public function getApplicantExpectations(): ValueObject\ApplicantExpectations
	{
		return $this->applicantExpectations;
	}
	
	/**
	 * @param ValueObject\ApplicantExpectations $applicantExpectations
	 * @return Rga
	 */
	public function setApplicantExpectations(ValueObject\ApplicantExpectations $applicantExpectations): Rga
	{
		$this->applicantExpectations = $applicantExpectations;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantDescriptionOfIncident
	 */
	public function getApplicantDescriptionOfIncident(): ValueObject\ApplicantDescriptionOfIncident
	{
		return $this->applicantDescriptionOfIncident;
	}
	
	/**
	 * @param ValueObject\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident
	 * @return Rga
	 */
	public function setApplicantDescriptionOfIncident(ValueObject\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident): Rga
	{
		$this->applicantDescriptionOfIncident = $applicantDescriptionOfIncident;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantContactPreference
	 */
	public function getApplicantContactPreference(): ValueObject\ApplicantContactPreference
	{
		return $this->applicantContactPreference;
	}
	
	/**
	 * @param ValueObject\ApplicantContactPreference $applicantContactPreference
	 * @return Rga
	 */
	public function setApplicantContactPreference(ValueObject\ApplicantContactPreference $applicantContactPreference): Rga
	{
		$this->applicantContactPreference = $applicantContactPreference;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantObjectType
	 */
	public function getApplicantObjectType(): ValueObject\ApplicantObjectType
	{
		return $this->applicantObjectType;
	}
	
	/**
	 * @param ValueObject\ApplicantObjectType $applicantObjectType
	 * @return Rga
	 */
	public function setApplicantObjectType(ValueObject\ApplicantObjectType $applicantObjectType): Rga
	{
		$this->applicantObjectType = $applicantObjectType;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantObjectId
	 */
	public function getApplicantObjectId(): ValueObject\ApplicantObjectId
	{
		return $this->applicantObjectId;
	}
	
	/**
	 * @param ValueObject\ApplicantObjectId $applicantObjectId
	 * @return Rga
	 */
	public function setApplicantObjectId(ValueObject\ApplicantObjectId $applicantObjectId): Rga
	{
		$this->applicantObjectId = $applicantObjectId;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantEmail
	 */
	public function getApplicantEmail(): ValueObject\ApplicantEmail
	{
		return $this->applicantEmail;
	}
	
	/**
	 * @param ValueObject\ApplicantEmail $applicantEmail
	 * @return Rga
	 */
	public function setApplicantEmail(ValueObject\ApplicantEmail $applicantEmail): Rga
	{
		$this->applicantEmail = $applicantEmail;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantTelephone
	 */
	public function getApplicantTelephone(): ValueObject\ApplicantTelephone
	{
		return $this->applicantTelephone;
	}
	
	/**
	 * @param ValueObject\ApplicantTelephone $applicantTelephone
	 * @return Rga
	 */
	public function setApplicantTelephone(ValueObject\ApplicantTelephone $applicantTelephone): Rga
	{
		$this->applicantTelephone = $applicantTelephone;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantFullName
	 */
	public function getApplicantFullName(): ValueObject\ApplicantFullName
	{
		return $this->applicantFullName;
	}
	
	/**
	 * @param ValueObject\ApplicantFullName $applicantFullName
	 * @return Rga
	 */
	public function setApplicantFullName(ValueObject\ApplicantFullName $applicantFullName): Rga
	{
		$this->applicantFullName = $applicantFullName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantStreetName
	 */
	public function getApplicantStreetName(): ValueObject\ApplicantStreetName
	{
		return $this->applicantStreetName;
	}
	
	/**
	 * @param ValueObject\ApplicantStreetName $applicantStreetName
	 * @return Rga
	 */
	public function setApplicantStreetName(ValueObject\ApplicantStreetName $applicantStreetName): Rga
	{
		$this->applicantStreetName = $applicantStreetName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantBuildingNumber
	 */
	public function getApplicantBuildingNumber(): ValueObject\ApplicantBuildingNumber
	{
		return $this->applicantBuildingNumber;
	}
	
	/**
	 * @param ValueObject\ApplicantBuildingNumber $applicantBuildingNumber
	 * @return Rga
	 */
	public function setApplicantBuildingNumber(ValueObject\ApplicantBuildingNumber $applicantBuildingNumber): Rga
	{
		$this->applicantBuildingNumber = $applicantBuildingNumber;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantApartmentNumber
	 */
	public function getApplicantApartmentNumber(): ValueObject\ApplicantApartmentNumber
	{
		return $this->applicantApartmentNumber;
	}
	
	/**
	 * @param ValueObject\ApplicantApartmentNumber $applicantApartmentNumber
	 * @return Rga
	 */
	public function setApplicantApartmentNumber(ValueObject\ApplicantApartmentNumber $applicantApartmentNumber): Rga
	{
		$this->applicantApartmentNumber = $applicantApartmentNumber;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantPostalCode
	 */
	public function getApplicantPostalCode(): ValueObject\ApplicantPostalCode
	{
		return $this->applicantPostalCode;
	}
	
	/**
	 * @param ValueObject\ApplicantPostalCode $applicantPostalCode
	 * @return Rga
	 */
	public function setApplicantPostalCode(ValueObject\ApplicantPostalCode $applicantPostalCode): Rga
	{
		$this->applicantPostalCode = $applicantPostalCode;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantCity
	 */
	public function getApplicantCity(): ValueObject\ApplicantCity
	{
		return $this->applicantCity;
	}
	
	/**
	 * @param ValueObject\ApplicantCity $applicantCity
	 * @return Rga
	 */
	public function setApplicantCity(ValueObject\ApplicantCity $applicantCity): Rga
	{
		$this->applicantCity = $applicantCity;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantCountryCode
	 */
	public function getApplicantCountryCode(): ValueObject\ApplicantCountryCode
	{
		return $this->applicantCountryCode;
	}
	
	/**
	 * @param ValueObject\ApplicantCountryCode $applicantCountryCode
	 * @return Rga
	 */
	public function setApplicantCountryCode(ValueObject\ApplicantCountryCode $applicantCountryCode): Rga
	{
		$this->applicantCountryCode = $applicantCountryCode;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantBankAccountNumber
	 */
	public function getApplicantBankAccountNumber(): ValueObject\ApplicantBankAccountNumber
	{
		return $this->applicantBankAccountNumber;
	}
	
	/**
	 * @param ValueObject\ApplicantBankAccountNumber $applicantBankAccountNumber
	 * @return Rga
	 */
	public function setApplicantBankAccountNumber(ValueObject\ApplicantBankAccountNumber $applicantBankAccountNumber): Rga
	{
		$this->applicantBankAccountNumber = $applicantBankAccountNumber;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\ApplicantBankName
	 */
	public function getApplicantBankName(): ValueObject\ApplicantBankName
	{
		return $this->applicantBankName;
	}
	
	/**
	 * @param ValueObject\ApplicantBankName $applicantBankName
	 * @return Rga
	 */
	public function setApplicantBankName(ValueObject\ApplicantBankName $applicantBankName): Rga
	{
		$this->applicantBankName = $applicantBankName;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\AdminNotes
	 */
	public function getAdminNotes(): ValueObject\AdminNotes
	{
		return $this->adminNotes;
	}
	
	/**
	 * @param ValueObject\AdminNotes $adminNotes
	 * @return Rga
	 */
	public function setAdminNotes(ValueObject\AdminNotes $adminNotes): Rga
	{
		$this->adminNotes = $adminNotes;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\AdminNotesForApplicant
	 */
	public function getAdminNotesForApplicant(): ValueObject\AdminNotesForApplicant
	{
		return $this->adminNotesForApplicant;
	}
	
	/**
	 * @param ValueObject\AdminNotesForApplicant $adminNotesForApplicant
	 * @return Rga
	 */
	public function setAdminNotesForApplicant(ValueObject\AdminNotesForApplicant $adminNotesForApplicant): Rga
	{
		$this->adminNotesForApplicant = $adminNotesForApplicant;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsProductReceived
	 */
	public function getIsProductReceived(): ValueObject\IsProductReceived
	{
		return $this->isProductReceived;
	}
	
	/**
	 * @param ValueObject\IsProductReceived $isProductReceived
	 * @return Rga
	 */
	public function setIsProductReceived(ValueObject\IsProductReceived $isProductReceived): Rga
	{
		$this->isProductReceived = $isProductReceived;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsCashReturned
	 */
	public function getIsCashReturned(): ValueObject\IsCashReturned
	{
		return $this->isCashReturned;
	}
	
	/**
	 * @param ValueObject\IsCashReturned $isCashReturned
	 * @return Rga
	 */
	public function setIsCashReturned(ValueObject\IsCashReturned $isCashReturned): Rga
	{
		$this->isCashReturned = $isCashReturned;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsProductReturned
	 */
	public function getIsProductReturned(): ValueObject\IsProductReturned
	{
		return $this->isProductReturned;
	}
	
	/**
	 * @param ValueObject\IsProductReturned $isProductReturned
	 * @return Rga
	 */
	public function setIsProductReturned(ValueObject\IsProductReturned $isProductReturned): Rga
	{
		$this->isProductReturned = $isProductReturned;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\IsDeleted
	 */
	public function getIsDeleted(): ValueObject\IsDeleted
	{
		return $this->isDeleted;
	}
	
	/**
	 * @param ValueObject\IsDeleted $isDeleted
	 * @return Rga
	 */
	public function setIsDeleted(ValueObject\IsDeleted $isDeleted): Rga
	{
		$this->isDeleted = $isDeleted;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageSent
	 */
	public function getPackageSent(): ValueObject\PackageSent
	{
		return $this->packageSent;
	}
	
	/**
	 * @param ValueObject\PackageSent $packageSent
	 * @return Rga
	 */
	public function setPackageSent(ValueObject\PackageSent $packageSent): Rga
	{
		$this->packageSent = $packageSent;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageNo
	 */
	public function getPackageNo(): ValueObject\PackageNo
	{
		return $this->packageNo;
	}
	
	/**
	 * @param ValueObject\PackageNo $packageNo
	 * @return Rga
	 */
	public function setPackageNo(ValueObject\PackageNo $packageNo): Rga
	{
		$this->packageNo = $packageNo;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\PackageSentAt
	 */
	public function getPackageSentAt(): ValueObject\PackageSentAt
	{
		return $this->packageSentAt;
	}
	
	/**
	 * @param ValueObject\PackageSentAt $packageSentAt
	 * @return Rga
	 */
	public function setPackageSentAt(ValueObject\PackageSentAt $packageSentAt): Rga
	{
		$this->packageSentAt = $packageSentAt;
		
		return $this;
	}
}