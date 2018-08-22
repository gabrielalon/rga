<?php

namespace RGA\Domain\Model\Base;

use RGA\Domain\Model\Attachment\AttachmentCollection;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Log\Metadata;
use RGA\Infrastructure\Model\Identify;

class Rga
	implements Identify\Guidable, Metadata\Loggable
{
	use Identify\Guided;
	use Metadata\LogAware;
	
	/** @var \DateTime */
	private $createdAt;
	
	/** @var \DateTime */
	private $modifiedAt;
	
	/** @var string */
	private $behaviourUuid;
	
	/** @var string */
	private $stateUuid;
	
	/** @var string */
	private $transportUuid;
	
	/** @var string */
	private $sourceObjectType;
	
	/** @var integer */
	private $sourceObjectID;
	
	/** @var integer */
	private $sourceObjectItemID;
	
	/** @var \DateTime */
	private $sourceDateOfCreation;
	
	/** @var string */
	private $productName;
	
	/** @var integer */
	private $productVariantID;
	
	/** @var string */
	private $applicantGivenSourceObjectID;
	
	/** @var string */
	private $applicantGivenSourceIdentification;
	
	/** @var string */
	private $applicantGivenProductName;
	
	/** @var string */
	private $applicantReasons;
	
	/** @var string */
	private $applicantExpectations;
	
	/** @var string */
	private $applicantDescriptionOfIncident;
	
	/** @var string */
	private $applicantContactPreference;
	
	/** @var string */
	private $applicantObjectType;
	
	/** @var integer */
	private $applicantObjectID;
	
	/** @var string */
	private $applicantEmail;
	
	/** @var string */
	private $applicantTelephone;
	
	/** @var string */
	private $applicantFullName;
	
	/** @var string */
	private $applicantStreetName;
	
	/** @var string */
	private $applicantBuildingNumber;
	
	/** @var string */
	private $applicantApartmentNumber;
	
	/** @var string */
	private $applicantPostalCode;
	
	/** @var string */
	private $applicantCity;
	
	/** @var string */
	private $applicantCountryCode;
	
	/** @var string */
	private $applicantBankAccountNumber;
	
	/** @var string */
	private $applicantBankName;
	
	/** @var string */
	private $adminNotes;
	
	/** @var string */
	private $adminNotesForApplicant;
	
	/** @var boolean */
	private $isProductReceived;
	
	/** @var boolean */
	private $isCashReturned;
	
	/** @var boolean */
	private $isProductReturned;
	
	/** @var boolean */
	private $isDeleted;
	
	/** @var boolean */
	private $packageSent;
	
	/** @var string */
	private $packageNo;
	
	/** @var \DateTime */
	private $packageSentAt;
	
	/** @var integer */
	private $individualNumber;
	
	/** @var integer */
	private $individualGroup;
	
	/** @var AttachmentCollection */
	private $attachments;
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}
	
	/**
	 * @param ValueObject\Base\CreatedAt $createdAt
	 */
	public function setCreatedAt(ValueObject\Base\CreatedAt $createdAt): void
	{
		$this->createdAt = $createdAt->getValue();
	}
	
	/**
	 * @return \DateTime
	 */
	public function getModifiedAt(): \DateTime
	{
		return $this->modifiedAt;
	}
	
	/**
	 * @param ValueObject\Base\ModifiedAt $modifiedAt
	 */
	public function setModifiedAt(ValueObject\Base\ModifiedAt $modifiedAt): void
	{
		$this->modifiedAt = $modifiedAt->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getBehaviourUuid(): string
	{
		return $this->behaviourUuid;
	}
	
	/**
	 * @param ValueObject\Base\BehaviourUuid $behaviourUuid
	 */
	public function setBehaviourUuid(ValueObject\Base\BehaviourUuid $behaviourUuid): void
	{
		$this->behaviourUuid = $behaviourUuid->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getStateUuid(): string
	{
		return $this->stateUuid;
	}
	
	/**
	 * @param ValueObject\Base\StateUuid $stateUuid
	 */
	public function setStateUuid(ValueObject\Base\StateUuid $stateUuid): void
	{
		$this->stateUuid = $stateUuid->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getTransportUuid(): string
	{
		return $this->transportUuid;
	}
	
	/**
	 * @param ValueObject\Base\TransportUuid $transportUuid
	 */
	public function setTransportUuid(ValueObject\Base\TransportUuid $transportUuid): void
	{
		$this->transportUuid = $transportUuid->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getSourceObjectType(): string
	{
		return $this->sourceObjectType;
	}
	
	/**
	 * @param ValueObject\Base\SourceObjectType $sourceObjectType
	 */
	public function setSourceObjectType(ValueObject\Base\SourceObjectType $sourceObjectType): void
	{
		$this->sourceObjectType = $sourceObjectType->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getSourceObjectID(): int
	{
		return $this->sourceObjectID;
	}
	
	/**
	 * @param ValueObject\Base\SourceObjectID $sourceObjectID
	 */
	public function setSourceObjectID(ValueObject\Base\SourceObjectID $sourceObjectID): void
	{
		$this->sourceObjectID = $sourceObjectID->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getSourceObjectItemID(): int
	{
		return $this->sourceObjectItemID;
	}
	
	/**
	 * @param ValueObject\Base\SourceObjectItemID $sourceObjectItemID
	 */
	public function setSourceObjectItemID(ValueObject\Base\SourceObjectItemID $sourceObjectItemID): void
	{
		$this->sourceObjectItemID = $sourceObjectItemID->getValue();
	}
	
	/**
	 * @return \DateTime
	 */
	public function getSourceDateOfCreation(): \DateTime
	{
		return $this->sourceDateOfCreation;
	}
	
	/**
	 * @param ValueObject\Base\SourceDateOfCreation $sourceDateOfCreation
	 */
	public function setSourceDateOfCreation(ValueObject\Base\SourceDateOfCreation $sourceDateOfCreation): void
	{
		$this->sourceDateOfCreation = $sourceDateOfCreation->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getProductName(): string
	{
		return $this->productName;
	}
	
	/**
	 * @param ValueObject\Base\ProductName $productName
	 */
	public function setProductName(ValueObject\Base\ProductName $productName): void
	{
		$this->productName = $productName->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getProductVariantID(): int
	{
		return $this->productVariantID;
	}
	
	/**
	 * @param ValueObject\Base\ProductVariantID $productVariantID
	 */
	public function setProductVariantID(ValueObject\Base\ProductVariantID $productVariantID): void
	{
		$this->productVariantID = $productVariantID->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantGivenSourceObjectID(): string
	{
		return $this->applicantGivenSourceObjectID;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantGivenSourceObjectID $applicantGivenSourceObjectID
	 */
	public function setApplicantGivenSourceObjectID(ValueObject\Base\ApplicantGivenSourceObjectID $applicantGivenSourceObjectID): void
	{
		$this->applicantGivenSourceObjectID = $applicantGivenSourceObjectID->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantGivenSourceIdentification(): string
	{
		return $this->applicantGivenSourceIdentification;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification
	 */
	public function setApplicantGivenSourceIdentification(ValueObject\Base\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification): void
	{
		$this->applicantGivenSourceIdentification = $applicantGivenSourceIdentification->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantGivenProductName(): string
	{
		return $this->applicantGivenProductName;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantGivenProductName $applicantGivenProductName
	 */
	public function setApplicantGivenProductName(ValueObject\Base\ApplicantGivenProductName $applicantGivenProductName): void
	{
		$this->applicantGivenProductName = $applicantGivenProductName->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantReasons(): string
	{
		return $this->applicantReasons;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantReasons $applicantReasons
	 */
	public function setApplicantReasons(ValueObject\Base\ApplicantReasons $applicantReasons): void
	{
		$this->applicantReasons = $applicantReasons->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantExpectations(): string
	{
		return $this->applicantExpectations;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantExpectations $applicantExpectations
	 */
	public function setApplicantExpectations(ValueObject\Base\ApplicantExpectations $applicantExpectations): void
	{
		$this->applicantExpectations = $applicantExpectations->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantDescriptionOfIncident(): string
	{
		return $this->applicantDescriptionOfIncident;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident
	 */
	public function setApplicantDescriptionOfIncident(ValueObject\Base\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident): void
	{
		$this->applicantDescriptionOfIncident = $applicantDescriptionOfIncident->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantContactPreference(): string
	{
		return $this->applicantContactPreference;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantContactPreference $applicantContactPreference
	 */
	public function setApplicantContactPreference(ValueObject\Base\ApplicantContactPreference $applicantContactPreference): void
	{
		$this->applicantContactPreference = $applicantContactPreference->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantObjectType(): string
	{
		return $this->applicantObjectType;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantObjectType $applicantObjectType
	 */
	public function setApplicantObjectType(ValueObject\Base\ApplicantObjectType $applicantObjectType): void
	{
		$this->applicantObjectType = $applicantObjectType->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getApplicantObjectID(): int
	{
		return $this->applicantObjectID;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantObjectID $applicantObjectID
	 */
	public function setApplicantObjectID(ValueObject\Base\ApplicantObjectID $applicantObjectID): void
	{
		$this->applicantObjectID = $applicantObjectID->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantEmail(): string
	{
		return $this->applicantEmail;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantEmail $applicantEmail
	 */
	public function setApplicantEmail(ValueObject\Base\ApplicantEmail $applicantEmail): void
	{
		$this->applicantEmail = $applicantEmail->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantTelephone(): string
	{
		return $this->applicantTelephone;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantTelephone $applicantTelephone
	 */
	public function setApplicantTelephone(ValueObject\Base\ApplicantTelephone $applicantTelephone): void
	{
		$this->applicantTelephone = $applicantTelephone->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantFullName(): string
	{
		return $this->applicantFullName;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantFullName $applicantFullName
	 */
	public function setApplicantFullName(ValueObject\Base\ApplicantFullName $applicantFullName): void
	{
		$this->applicantFullName = $applicantFullName->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantStreetName(): string
	{
		return $this->applicantStreetName;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantStreetName $applicantStreetName
	 */
	public function setApplicantStreetName(ValueObject\Base\ApplicantStreetName $applicantStreetName): void
	{
		$this->applicantStreetName = $applicantStreetName->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantBuildingNumber(): string
	{
		return $this->applicantBuildingNumber;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantBuildingNumber $applicantBuildingNumber
	 */
	public function setApplicantBuildingNumber(ValueObject\Base\ApplicantBuildingNumber $applicantBuildingNumber): void
	{
		$this->applicantBuildingNumber = $applicantBuildingNumber->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantApartmentNumber(): string
	{
		return $this->applicantApartmentNumber;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantApartmentNumber $applicantApartmentNumber
	 */
	public function setApplicantApartmentNumber(ValueObject\Base\ApplicantApartmentNumber $applicantApartmentNumber): void
	{
		$this->applicantApartmentNumber = $applicantApartmentNumber->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantPostalCode(): string
	{
		return $this->applicantPostalCode;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantPostalCode $applicantPostalCode
	 */
	public function setApplicantPostalCode(ValueObject\Base\ApplicantPostalCode $applicantPostalCode): void
	{
		$this->applicantPostalCode = $applicantPostalCode->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantCity(): string
	{
		return $this->applicantCity;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantCity $applicantCity
	 */
	public function setApplicantCity(ValueObject\Base\ApplicantCity $applicantCity): void
	{
		$this->applicantCity = $applicantCity->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantCountryCode(): string
	{
		return $this->applicantCountryCode;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantCountryCode $applicantCountryCode
	 */
	public function setApplicantCountryCode(ValueObject\Base\ApplicantCountryCode $applicantCountryCode): void
	{
		$this->applicantCountryCode = $applicantCountryCode->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantBankAccountNumber(): ?string
	{
		return $this->applicantBankAccountNumber;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantBankAccountNumber $applicantBankAccountNumber
	 */
	public function setApplicantBankAccountNumber(ValueObject\Base\ApplicantBankAccountNumber $applicantBankAccountNumber): void
	{
		$this->applicantBankAccountNumber = $applicantBankAccountNumber->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getApplicantBankName(): ?string
	{
		return $this->applicantBankName;
	}
	
	/**
	 * @param ValueObject\Base\ApplicantBankName $applicantBankName
	 */
	public function setApplicantBankName(ValueObject\Base\ApplicantBankName $applicantBankName): void
	{
		$this->applicantBankName = $applicantBankName->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getAdminNotes(): ?string
	{
		return $this->adminNotes;
	}
	
	/**
	 * @param ValueObject\Base\AdminNotes $adminNotes
	 */
	public function setAdminNotes(ValueObject\Base\AdminNotes $adminNotes): void
	{
		$this->adminNotes = $adminNotes->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getAdminNotesForApplicant(): ?string
	{
		return $this->adminNotesForApplicant;
	}
	
	/**
	 * @param ValueObject\Base\AdminNotesForApplicant $adminNotesForApplicant
	 */
	public function setAdminNotesForApplicant(ValueObject\Base\AdminNotesForApplicant $adminNotesForApplicant): void
	{
		$this->adminNotesForApplicant = $adminNotesForApplicant->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isProductReceived(): bool
	{
		return (bool)$this->isProductReceived;
	}
	
	/**
	 * @param ValueObject\Base\IsProductReceived $isProductReceived
	 */
	public function setIsProductReceived(ValueObject\Base\IsProductReceived $isProductReceived): void
	{
		$this->isProductReceived = $isProductReceived->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isCashReturned(): bool
	{
		return (bool)$this->isCashReturned;
	}
	
	/**
	 * @param ValueObject\Base\IsCashReturned $isCashReturned
	 */
	public function setIsCashReturned(ValueObject\Base\IsCashReturned $isCashReturned): void
	{
		$this->isCashReturned = $isCashReturned->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isProductReturned(): bool
	{
		return (bool)$this->isProductReturned;
	}
	
	/**
	 * @param ValueObject\Base\IsProductReturned $isProductReturned
	 */
	public function setIsProductReturned(ValueObject\Base\IsProductReturned $isProductReturned): void
	{
		$this->isProductReturned = $isProductReturned->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isDeleted(): bool
	{
		return (bool)$this->isDeleted;
	}
	
	/**
	 * @param ValueObject\Base\IsDeleted $isDeleted
	 */
	public function setIsDeleted(ValueObject\Base\IsDeleted $isDeleted): void
	{
		$this->isDeleted = $isDeleted->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isPackageSent(): bool
	{
		return (bool)$this->packageSent;
	}
	
	/**
	 * @param ValueObject\Base\PackageSent $packageSent
	 */
	public function setPackageSent(ValueObject\Base\PackageSent $packageSent): void
	{
		$this->packageSent = $packageSent->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getPackageNo(): ?string
	{
		return $this->packageNo;
	}
	
	/**
	 * @param ValueObject\Base\PackageNo $packageNo
	 */
	public function setPackageNo(ValueObject\Base\PackageNo $packageNo): void
	{
		$this->packageNo = $packageNo->getValue();
	}
	
	/**
	 * @return \DateTime
	 */
	public function getPackageSentAt(): ?\DateTime
	{
		return $this->packageSentAt;
	}
	
	/**
	 * @param ValueObject\Base\PackageSentAt $packageSentAt
	 */
	public function setPackageSentAt(ValueObject\Base\PackageSentAt $packageSentAt): void
	{
		$this->packageSentAt = $packageSentAt->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getIndividualNumber(): int
	{
		return (int)$this->individualNumber;
	}
	
	/**
	 * @param ValueObject\Base\IndividualNumber $individualNumber
	 */
	public function setIndividualNumber(ValueObject\Base\IndividualNumber $individualNumber): void
	{
		$this->individualNumber = $individualNumber->getValue();
	}
	
	/**
	 * @return int
	 */
	public function getIndividualGroup(): int
	{
		return (int)$this->individualGroup;
	}
	
	/**
	 * @param ValueObject\Base\IndividualGroup $individualGroup
	 */
	public function setIndividualGroup(ValueObject\Base\IndividualGroup $individualGroup): void
	{
		$this->individualGroup = $individualGroup->getValue();
	}
	
	/**
	 * @param AttachmentCollection $attachments
	 */
	public function setAttachments(AttachmentCollection $attachments): void
	{
		$this->attachments = $attachments;
	}
}