<?php

namespace RGA\Application\Rga\Query\ReadModel;

use RGA\Domain\Model\Rga\Rga as VO;
use RGA\Domain\Model\State\State as VOState;
use RGA\Domain\Model\Behaviour\Behaviour as VOBehaviour;
use RGA\Domain\Model\Transport\Transport as VOTransport;
use RGA\Infrastructure\SegregationSourcing;

class Rga implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Uuid */
    private $identifier;
    
    /** @var VO\CreatedAt */
    private $createdAt;
    
    /** @var VO\ModifiedAt */
    private $modifiedAt;
    
    /** @var VO\BehaviourUuid */
    private $behaviourUuid;
    
    /** @var VOBehaviour\Names */
    private $behaviourNames;
    
    /** @var VOBehaviour\Type */
    private $behaviourType;
    
    /** @var VO\StateUuid */
    private $stateUuid;
    
    /** @var VOState\Names */
    private $stateNames;
    
    /** @var VO\TransportUuid */
    private $transportUuid;
    
    /** @var VOTransport\Names */
    private $transportNames;
    
    /** @var VO\SourceObjectType */
    private $sourceObjectType;
    
    /** @var VO\SourceObjectId */
    private $sourceObjectId;
    
    /** @var VO\SourceObjectItemId */
    private $sourceObjectItemId;

    /** @var VO\SourceObjectItemQuantity */
    private $sourceObjectItemQuantity;
    
    /** @var VO\SourceDateOfCreation */
    private $sourceDateOfCreation;
    
    /** @var VO\ProductName */
    private $productName;
    
    /** @var VO\ProductVariantId */
    private $productVariantId;
    
    /** @var VO\ApplicantGivenSourceObjectId */
    private $applicantGivenSourceObjectId;
    
    /** @var VO\ApplicantGivenSourceIdentification */
    private $applicantGivenSourceIdentification;
    
    /** @var VO\ApplicantGivenProductName */
    private $applicantGivenProductName;
    
    /** @var VO\ApplicantReasons */
    private $applicantReasons;
    
    /** @var VO\ApplicantExpectations */
    private $applicantExpectations;
    
    /** @var VO\ApplicantDescriptionOfIncident */
    private $applicantDescriptionOfIncident;
    
    /** @var VO\ApplicantContactPreference */
    private $applicantContactPreference;
    
    /** @var VO\ApplicantObjectType */
    private $applicantObjectType;
    
    /** @var VO\ApplicantObjectId */
    private $applicantObjectId;
    
    /** @var VO\ApplicantEmail */
    private $applicantEmail;
    
    /** @var VO\ApplicantTelephone */
    private $applicantTelephone;
    
    /** @var VO\ApplicantFullName */
    private $applicantFullName;
    
    /** @var VO\ApplicantStreetName */
    private $applicantStreetName;
    
    /** @var VO\ApplicantBuildingNumber */
    private $applicantBuildingNumber;
    
    /** @var VO\ApplicantApartmentNumber */
    private $applicantApartmentNumber;
    
    /** @var VO\ApplicantPostalCode */
    private $applicantPostalCode;
    
    /** @var VO\ApplicantCity */
    private $applicantCity;
    
    /** @var VO\ApplicantCountryId */
    private $applicantCountryId;
    
    /** @var VO\ApplicantCountryCode */
    private $applicantCountryCode;
    
    /** @var VO\ApplicantBankAccountNumber */
    private $applicantBankAccountNumber;
    
    /** @var VO\ApplicantBankName */
    private $applicantBankName;
    
    /** @var VO\AdminNotes */
    private $adminNotes;
    
    /** @var VO\AdminNotesForApplicant */
    private $adminNotesForApplicant;
    
    /** @var VO\IsProductReceived */
    private $isProductReceived;
    
    /** @var VO\IsCashReturned */
    private $isCashReturned;
    
    /** @var VO\IsProductReturned */
    private $isProductReturned;
    
    /** @var VO\IsDeleted */
    private $isDeleted;
    
    /** @var VO\PackageSent */
    private $packageSent;
    
    /** @var VO\PackageNo */
    private $packageNo;
    
    /** @var VO\PackageSentAt */
    private $packageSentAt;
    
    /** @var VO\IndividualNumber */
    private $individualNumber;
    
    /** @var VO\Hash */
    private $hash;
    
    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setIdentifier(VO\Uuid::fromString($uuid));
    }
    
    /**
     * @param string $uuid
     * @return Rga
     */
    public static function fromUuid(string $uuid): Rga
    {
        return new static($uuid);
    }
    
    /**
     * @return string
     */
    public function identifier(): string
    {
        return $this->identifier->toString();
    }
    
    /**
     * @return VO\Uuid
     */
    public function getIdentifier(): VO\Uuid
    {
        return $this->identifier;
    }
    
    /**
     * @param VO\Uuid $identifier
     * @return Rga
     */
    public function setIdentifier(VO\Uuid $identifier): Rga
    {
        $this->identifier = $identifier;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->createdAt->toString();
    }
    
    /**
     * @return VO\CreatedAt
     */
    public function getCreatedAt(): VO\CreatedAt
    {
        return $this->createdAt;
    }
    
    /**
     * @param VO\CreatedAt $createdAt
     * @return Rga
     */
    public function setCreatedAt(VO\CreatedAt $createdAt): Rga
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function modifiedAt(): string
    {
        return $this->modifiedAt->toString();
    }
    
    /**
     * @return VO\ModifiedAt
     */
    public function getModifiedAt(): VO\ModifiedAt
    {
        return $this->modifiedAt;
    }
    
    /**
     * @param VO\ModifiedAt $modifiedAt
     * @return Rga
     */
    public function setModifiedAt(VO\ModifiedAt $modifiedAt): Rga
    {
        $this->modifiedAt = $modifiedAt;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function behaviourUuid(): string
    {
        return $this->behaviourUuid->toString();
    }
    
    /**
     * @return VO\BehaviourUuid
     */
    public function getBehaviourUuid(): VO\BehaviourUuid
    {
        return $this->behaviourUuid;
    }
    
    /**
     * @param VO\BehaviourUuid $behaviourUuid
     * @return Rga
     */
    public function setBehaviourUuid(VO\BehaviourUuid $behaviourUuid): Rga
    {
        $this->behaviourUuid = $behaviourUuid;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function behaviourName(string $locale): string
    {
        return $this->behaviourNames->getLocale($locale)->toString();
    }
    
    /**
     * @return VOBehaviour\Names
     */
    public function behaviourNames(): VOBehaviour\Names
    {
        return $this->behaviourNames;
    }
    
    /**
     * @return VOBehaviour\Names
     */
    public function getBehaviourNames(): VOBehaviour\Names
    {
        return $this->behaviourNames;
    }
    
    /**
     * @param string $locale
     * @param string $name
     * @return Rga
     */
    public function addBehaviourName(string $locale, string $name = ''): Rga
    {
        if (null === $this->behaviourNames) {
            $this->setBehaviourNames(VOBehaviour\Names::fromArray([
                $locale => $name
            ]));
        } else {
            $this->behaviourNames->addLocale($locale, $name);
        }
        
        return $this;
    }
    
    /**
     * @param VOBehaviour\Names $behaviourNames
     * @return Rga
     */
    public function setBehaviourNames(VOBehaviour\Names $behaviourNames): Rga
    {
        $this->behaviourNames = $behaviourNames;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function behaviourType(): string
    {
        return $this->behaviourType->toString();
    }
    
    /**
     * @return VOBehaviour\Type
     */
    public function getBehaviourType(): VOBehaviour\Type
    {
        return $this->behaviourType;
    }
    
    /**
     * @param VOBehaviour\Type $behaviourType
     * @return Rga
     */
    public function setBehaviourType(VOBehaviour\Type $behaviourType): Rga
    {
        $this->behaviourType = $behaviourType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function stateUuid(): string
    {
        return $this->stateUuid->toString();
    }
    
    /**
     * @return VO\StateUuid
     */
    public function getStateUuid(): VO\StateUuid
    {
        return $this->stateUuid;
    }
    
    /**
     * @param VO\StateUuid $stateUuid
     * @return Rga
     */
    public function setStateUuid(VO\StateUuid $stateUuid): Rga
    {
        $this->stateUuid = $stateUuid;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function stateName(string $locale): string
    {
        return $this->stateNames->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function stateNames(): array
    {
        return $this->stateNames->raw();
    }
    
    /**
     * @return VOState\Names
     */
    public function getStateNames(): VOState\Names
    {
        return $this->stateNames;
    }
    
    /**
     * @param string $locale
     * @param string $name
     * @return Rga
     */
    public function addStateName(string $locale, ?string $name): Rga
    {
        $name = $name ?? '';
        if (null === $this->stateNames) {
            $this->setStateNames(VOState\Names::fromArray([
                $locale => $name
            ]));
        } else {
            $this->stateNames->addLocale($locale, $name);
        }
        
        return $this;
    }
    
    /**
     * @param VOState\Names $stateNames
     * @return Rga
     */
    public function setStateNames(VOState\Names $stateNames): Rga
    {
        $this->stateNames = $stateNames;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function transportUuid(): string
    {
        return $this->transportUuid->toString();
    }
    
    /**
     * @return VO\TransportUuid
     */
    public function getTransportUuid(): VO\TransportUuid
    {
        return $this->transportUuid;
    }
    
    /**
     * @param VO\TransportUuid $transportUuid
     * @return Rga
     */
    public function setTransportUuid(VO\TransportUuid $transportUuid): Rga
    {
        $this->transportUuid = $transportUuid;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function transportName(string $locale): string
    {
        return $this->transportNames->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function transportNames(): array
    {
        return $this->transportNames->raw();
    }
    
    /**
     * @return VOTransport\Names
     */
    public function getTransportNames(): VOTransport\Names
    {
        return $this->transportNames;
    }
    
    /**
     * @param string $locale
     * @param string $name
     * @return Rga
     */
    public function addTransportName(string $locale, ?string $name): Rga
    {
        $name = $name ?? '';
        if (null === $this->transportNames) {
            $this->setTransportNames(VOTransport\Names::fromArray([
                $locale => $name
            ]));
        } else {
            $this->transportNames->addLocale($locale, $name);
        }
        
        return $this;
    }
    
    /**
     * @param VOTransport\Names $transportNames
     * @return Rga
     */
    public function setTransportNames(VOTransport\Names $transportNames): Rga
    {
        $this->transportNames = $transportNames;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function sourceObjectType(): string
    {
        return $this->sourceObjectType->toString();
    }
    
    /**
     * @return VO\SourceObjectType
     */
    public function getSourceObjectType(): VO\SourceObjectType
    {
        return $this->sourceObjectType;
    }
    
    /**
     * @param VO\SourceObjectType $sourceObjectType
     * @return Rga
     */
    public function setSourceObjectType(VO\SourceObjectType $sourceObjectType): Rga
    {
        $this->sourceObjectType = $sourceObjectType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function sourceObjectId(): string
    {
        return $this->sourceObjectId->toString();
    }
    
    /**
     * @return VO\SourceObjectId
     */
    public function getSourceObjectId(): VO\SourceObjectId
    {
        return $this->sourceObjectId;
    }
    
    /**
     * @param VO\SourceObjectId $sourceObjectId
     * @return Rga
     */
    public function setSourceObjectId(VO\SourceObjectId $sourceObjectId): Rga
    {
        $this->sourceObjectId = $sourceObjectId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function sourceObjectItemId(): string
    {
        return $this->sourceObjectItemId->toString();
    }

    public function sourceObjectItemQuantity(): string
    {
        return $this->sourceObjectItemQuantity->toString();
    }
    
    /**
     * @return VO\SourceObjectItemId
     */
    public function getSourceObjectItemId(): VO\SourceObjectItemId
    {
        return $this->sourceObjectItemId;
    }

    public function getSourceObjectItemQuantity(): VO\SourceObjectItemQuantity
    {
        return $this->sourceObjectItemQuantity;
    }
    
    /**
     * @param VO\SourceObjectItemId $sourceObjectItemId
     * @return Rga
     */
    public function setSourceObjectItemId(VO\SourceObjectItemId $sourceObjectItemId): Rga
    {
        $this->sourceObjectItemId = $sourceObjectItemId;
        
        return $this;
    }

    public function setSourceObjectItemQuantity(VO\SourceObjectItemQuantity $sourceObjectItemQuantity): Rga
    {
        $this->sourceObjectItemQuantity = $sourceObjectItemQuantity;

        return $this;
    }
    
    /**
     * @return string
     */
    public function sourceDateOfCreation(): string
    {
        return $this->sourceDateOfCreation->toString();
    }
    
    /**
     * @return VO\SourceDateOfCreation
     */
    public function getSourceDateOfCreation(): VO\SourceDateOfCreation
    {
        return $this->sourceDateOfCreation;
    }
    
    /**
     * @param VO\SourceDateOfCreation $sourceDateOfCreation
     * @return Rga
     */
    public function setSourceDateOfCreation(VO\SourceDateOfCreation $sourceDateOfCreation): Rga
    {
        $this->sourceDateOfCreation = $sourceDateOfCreation;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function productName(): string
    {
        return $this->productName->toString();
    }
    
    /**
     * @return VO\ProductName
     */
    public function getProductName(): VO\ProductName
    {
        return $this->productName;
    }
    
    /**
     * @param VO\ProductName $productName
     * @return Rga
     */
    public function setProductName(VO\ProductName $productName): Rga
    {
        $this->productName = $productName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function productVariantId(): string
    {
        return $this->productVariantId->toString();
    }
    
    /**
     * @return VO\ProductVariantId
     */
    public function getProductVariantId(): VO\ProductVariantId
    {
        return $this->productVariantId;
    }
    
    /**
     * @param VO\ProductVariantId $productVariantId
     * @return Rga
     */
    public function setProductVariantId(VO\ProductVariantId $productVariantId): Rga
    {
        $this->productVariantId = $productVariantId;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantGivenSourceObjectId
     */
    public function applicantGivenSourceObjectId(): VO\ApplicantGivenSourceObjectId
    {
        return $this->applicantGivenSourceObjectId;
    }
    
    /**
     * @return VO\ApplicantGivenSourceObjectId
     */
    public function getApplicantGivenSourceObjectId(): VO\ApplicantGivenSourceObjectId
    {
        return $this->applicantGivenSourceObjectId;
    }
    
    /**
     * @param VO\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId
     * @return Rga
     */
    public function setApplicantGivenSourceObjectId(VO\ApplicantGivenSourceObjectId $applicantGivenSourceObjectId): Rga
    {
        $this->applicantGivenSourceObjectId = $applicantGivenSourceObjectId;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantGivenSourceIdentification
     */
    public function applicantGivenSourceIdentification(): VO\ApplicantGivenSourceIdentification
    {
        return $this->applicantGivenSourceIdentification;
    }
    
    /**
     * @return VO\ApplicantGivenSourceIdentification
     */
    public function getApplicantGivenSourceIdentification(): VO\ApplicantGivenSourceIdentification
    {
        return $this->applicantGivenSourceIdentification;
    }
    
    /**
     * @param VO\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification
     * @return Rga
     */
    public function setApplicantGivenSourceIdentification(VO\ApplicantGivenSourceIdentification $applicantGivenSourceIdentification): Rga
    {
        $this->applicantGivenSourceIdentification = $applicantGivenSourceIdentification;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantGivenProductName
     */
    public function applicantGivenProductName(): VO\ApplicantGivenProductName
    {
        return $this->applicantGivenProductName;
    }
    
    /**
     * @return VO\ApplicantGivenProductName
     */
    public function getApplicantGivenProductName(): VO\ApplicantGivenProductName
    {
        return $this->applicantGivenProductName;
    }
    
    /**
     * @param VO\ApplicantGivenProductName $applicantGivenProductName
     * @return Rga
     */
    public function setApplicantGivenProductName(VO\ApplicantGivenProductName $applicantGivenProductName): Rga
    {
        $this->applicantGivenProductName = $applicantGivenProductName;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantReasons
     */
    public function applicantReasons(): VO\ApplicantReasons
    {
        return $this->applicantReasons;
    }
    
    /**
     * @return VO\ApplicantReasons
     */
    public function getApplicantReasons(): VO\ApplicantReasons
    {
        return $this->applicantReasons;
    }
    
    /**
     * @param VO\ApplicantReasons $applicantReasons
     * @return Rga
     */
    public function setApplicantReasons(VO\ApplicantReasons $applicantReasons): Rga
    {
        $this->applicantReasons = $applicantReasons;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantExpectations
     */
    public function applicantExpectations(): VO\ApplicantExpectations
    {
        return $this->applicantExpectations;
    }
    
    /**
     * @return VO\ApplicantExpectations
     */
    public function getApplicantExpectations(): VO\ApplicantExpectations
    {
        return $this->applicantExpectations;
    }
    
    /**
     * @param VO\ApplicantExpectations $applicantExpectations
     * @return Rga
     */
    public function setApplicantExpectations(VO\ApplicantExpectations $applicantExpectations): Rga
    {
        $this->applicantExpectations = $applicantExpectations;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantDescriptionOfIncident
     */
    public function applicantDescriptionOfIncident(): VO\ApplicantDescriptionOfIncident
    {
        return $this->applicantDescriptionOfIncident;
    }
    
    /**
     * @return VO\ApplicantDescriptionOfIncident
     */
    public function getApplicantDescriptionOfIncident(): VO\ApplicantDescriptionOfIncident
    {
        return $this->applicantDescriptionOfIncident;
    }
    
    /**
     * @param VO\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident
     * @return Rga
     */
    public function setApplicantDescriptionOfIncident(VO\ApplicantDescriptionOfIncident $applicantDescriptionOfIncident): Rga
    {
        $this->applicantDescriptionOfIncident = $applicantDescriptionOfIncident;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantContactPreference
     */
    public function applicantContactPreference(): VO\ApplicantContactPreference
    {
        return $this->applicantContactPreference;
    }
    
    /**
     * @return VO\ApplicantContactPreference
     */
    public function getApplicantContactPreference(): VO\ApplicantContactPreference
    {
        return $this->applicantContactPreference;
    }
    
    /**
     * @param VO\ApplicantContactPreference $applicantContactPreference
     * @return Rga
     */
    public function setApplicantContactPreference(VO\ApplicantContactPreference $applicantContactPreference): Rga
    {
        $this->applicantContactPreference = $applicantContactPreference;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantObjectType(): string
    {
        return $this->applicantObjectType->toString();
    }
    
    /**
     * @return VO\ApplicantObjectType
     */
    public function getApplicantObjectType(): VO\ApplicantObjectType
    {
        return $this->applicantObjectType;
    }
    
    /**
     * @param VO\ApplicantObjectType $applicantObjectType
     * @return Rga
     */
    public function setApplicantObjectType(VO\ApplicantObjectType $applicantObjectType): Rga
    {
        $this->applicantObjectType = $applicantObjectType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantObjectId(): string
    {
        return $this->applicantObjectId->toString();
    }
    
    /**
     * @return VO\ApplicantObjectId
     */
    public function getApplicantObjectId(): VO\ApplicantObjectId
    {
        return $this->applicantObjectId;
    }
    
    /**
     * @param VO\ApplicantObjectId $applicantObjectId
     * @return Rga
     */
    public function setApplicantObjectId(VO\ApplicantObjectId $applicantObjectId): Rga
    {
        $this->applicantObjectId = $applicantObjectId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantEmail(): string
    {
        return $this->applicantEmail->toString();
    }
    
    /**
     * @return VO\ApplicantEmail
     */
    public function getApplicantEmail(): VO\ApplicantEmail
    {
        return $this->applicantEmail;
    }
    
    /**
     * @param VO\ApplicantEmail $applicantEmail
     * @return Rga
     */
    public function setApplicantEmail(VO\ApplicantEmail $applicantEmail): Rga
    {
        $this->applicantEmail = $applicantEmail;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantTelephone(): string
    {
        return $this->applicantTelephone->toString();
    }
    
    /**
     * @return VO\ApplicantTelephone
     */
    public function getApplicantTelephone(): VO\ApplicantTelephone
    {
        return $this->applicantTelephone;
    }
    
    /**
     * @param VO\ApplicantTelephone $applicantTelephone
     * @return Rga
     */
    public function setApplicantTelephone(VO\ApplicantTelephone $applicantTelephone): Rga
    {
        $this->applicantTelephone = $applicantTelephone;
        
        return $this;
    }
    
    /**
     * @return VO\ApplicantFullName
     */
    public function getApplicantFullName(): VO\ApplicantFullName
    {
        return $this->applicantFullName;
    }
    
    /**
     * @return string
     */
    public function applicantFullName(): string
    {
        return $this->applicantFullName->toString();
    }
    
    /**
     * @param VO\ApplicantFullName $applicantFullName
     * @return Rga
     */
    public function setApplicantFullName(VO\ApplicantFullName $applicantFullName): Rga
    {
        $this->applicantFullName = $applicantFullName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantStreetName(): string
    {
        return $this->applicantStreetName->toString();
    }
    
    /**
     * @return VO\ApplicantStreetName
     */
    public function getApplicantStreetName(): VO\ApplicantStreetName
    {
        return $this->applicantStreetName;
    }
    
    /**
     * @param VO\ApplicantStreetName $applicantStreetName
     * @return Rga
     */
    public function setApplicantStreetName(VO\ApplicantStreetName $applicantStreetName): Rga
    {
        $this->applicantStreetName = $applicantStreetName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantBuildingNumber(): string
    {
        return $this->applicantBuildingNumber->toString();
    }
    
    /**
     * @return VO\ApplicantBuildingNumber
     */
    public function getApplicantBuildingNumber(): VO\ApplicantBuildingNumber
    {
        return $this->applicantBuildingNumber;
    }
    
    /**
     * @param VO\ApplicantBuildingNumber $applicantBuildingNumber
     * @return Rga
     */
    public function setApplicantBuildingNumber(VO\ApplicantBuildingNumber $applicantBuildingNumber): Rga
    {
        $this->applicantBuildingNumber = $applicantBuildingNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantApartmentNumber(): string
    {
        return $this->applicantApartmentNumber->toString();
    }
    
    /**
     * @return VO\ApplicantApartmentNumber
     */
    public function getApplicantApartmentNumber(): VO\ApplicantApartmentNumber
    {
        return $this->applicantApartmentNumber;
    }
    
    /**
     * @param VO\ApplicantApartmentNumber $applicantApartmentNumber
     * @return Rga
     */
    public function setApplicantApartmentNumber(VO\ApplicantApartmentNumber $applicantApartmentNumber): Rga
    {
        $this->applicantApartmentNumber = $applicantApartmentNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantPostalCode(): string
    {
        return $this->applicantPostalCode->toString();
    }
    
    /**
     * @return VO\ApplicantPostalCode
     */
    public function getApplicantPostalCode(): VO\ApplicantPostalCode
    {
        return $this->applicantPostalCode;
    }
    
    /**
     * @param VO\ApplicantPostalCode $applicantPostalCode
     * @return Rga
     */
    public function setApplicantPostalCode(VO\ApplicantPostalCode $applicantPostalCode): Rga
    {
        $this->applicantPostalCode = $applicantPostalCode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantCity(): string
    {
        return $this->applicantCity->toString();
    }
    
    /**
     * @return VO\ApplicantCity
     */
    public function getApplicantCity(): VO\ApplicantCity
    {
        return $this->applicantCity;
    }
    
    /**
     * @param VO\ApplicantCity $applicantCity
     * @return Rga
     */
    public function setApplicantCity(VO\ApplicantCity $applicantCity): Rga
    {
        $this->applicantCity = $applicantCity;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantCountryId(): string
    {
        return $this->applicantCountryId->toString();
    }
    
    /**
     * @return VO\ApplicantCountryId
     */
    public function getApplicantCountryId(): VO\ApplicantCountryId
    {
        return $this->applicantCountryId;
    }
    
    /**
     * @param VO\ApplicantCountryId $applicantCountryId
     * @return Rga
     */
    public function setApplicantCountryId(VO\ApplicantCountryId $applicantCountryId): Rga
    {
        $this->applicantCountryId = $applicantCountryId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantCountryCode(): string
    {
        return $this->applicantCountryCode->toString();
    }
    
    /**
     * @return VO\ApplicantCountryCode
     */
    public function getApplicantCountryCode(): VO\ApplicantCountryCode
    {
        return $this->applicantCountryCode;
    }
    
    /**
     * @param VO\ApplicantCountryCode $applicantCountryCode
     * @return Rga
     */
    public function setApplicantCountryCode(VO\ApplicantCountryCode $applicantCountryCode): Rga
    {
        $this->applicantCountryCode = $applicantCountryCode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantBankAccountNumber(): string
    {
        return $this->applicantBankAccountNumber->toString();
    }
    
    /**
     * @return VO\ApplicantBankAccountNumber
     */
    public function getApplicantBankAccountNumber(): VO\ApplicantBankAccountNumber
    {
        return $this->applicantBankAccountNumber;
    }
    
    /**
     * @param VO\ApplicantBankAccountNumber $applicantBankAccountNumber
     * @return Rga
     */
    public function setApplicantBankAccountNumber(VO\ApplicantBankAccountNumber $applicantBankAccountNumber): Rga
    {
        $this->applicantBankAccountNumber = $applicantBankAccountNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function applicantBankName(): string
    {
        return $this->applicantBankName->toString();
    }
    
    /**
     * @return VO\ApplicantBankName
     */
    public function getApplicantBankName(): VO\ApplicantBankName
    {
        return $this->applicantBankName;
    }
    
    /**
     * @param VO\ApplicantBankName $applicantBankName
     * @return Rga
     */
    public function setApplicantBankName(VO\ApplicantBankName $applicantBankName): Rga
    {
        $this->applicantBankName = $applicantBankName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function adminNotes(): string
    {
        return $this->adminNotes->toString();
    }
    
    /**
     * @return VO\AdminNotes
     */
    public function getAdminNotes(): VO\AdminNotes
    {
        return $this->adminNotes;
    }
    
    /**
     * @param VO\AdminNotes $adminNotes
     * @return Rga
     */
    public function setAdminNotes(VO\AdminNotes $adminNotes): Rga
    {
        $this->adminNotes = $adminNotes;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function adminNotesForApplicant(): string
    {
        return $this->adminNotesForApplicant->toString();
    }
    
    /**
     * @return VO\AdminNotesForApplicant
     */
    public function getAdminNotesForApplicant(): VO\AdminNotesForApplicant
    {
        return $this->adminNotesForApplicant;
    }
    
    /**
     * @param VO\AdminNotesForApplicant $adminNotesForApplicant
     * @return Rga
     */
    public function setAdminNotesForApplicant(VO\AdminNotesForApplicant $adminNotesForApplicant): Rga
    {
        $this->adminNotesForApplicant = $adminNotesForApplicant;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isProductReceived(): bool
    {
        return (bool)$this->isProductReceived->toString();
    }
    
    /**
     * @return VO\IsProductReceived
     */
    public function getIsProductReceived(): VO\IsProductReceived
    {
        return $this->isProductReceived;
    }
    
    /**
     * @param VO\IsProductReceived $isProductReceived
     * @return Rga
     */
    public function setIsProductReceived(VO\IsProductReceived $isProductReceived): Rga
    {
        $this->isProductReceived = $isProductReceived;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isCashReturned(): bool
    {
        return (bool)$this->isCashReturned->toString();
    }
    
    /**
     * @return VO\IsCashReturned
     */
    public function getIsCashReturned(): VO\IsCashReturned
    {
        return $this->isCashReturned;
    }
    
    /**
     * @param VO\IsCashReturned $isCashReturned
     * @return Rga
     */
    public function setIsCashReturned(VO\IsCashReturned $isCashReturned): Rga
    {
        $this->isCashReturned = $isCashReturned;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isProductReturned(): bool
    {
        return (bool)$this->isProductReturned->toString();
    }
    
    /**
     * @return VO\IsProductReturned
     */
    public function getIsProductReturned(): VO\IsProductReturned
    {
        return $this->isProductReturned;
    }
    
    /**
     * @param VO\IsProductReturned $isProductReturned
     * @return Rga
     */
    public function setIsProductReturned(VO\IsProductReturned $isProductReturned): Rga
    {
        $this->isProductReturned = $isProductReturned;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return (bool)$this->isDeleted->toString();
    }
    
    /**
     * @return VO\IsDeleted
     */
    public function getIsDeleted(): VO\IsDeleted
    {
        return $this->isDeleted;
    }
    
    /**
     * @param VO\IsDeleted $isDeleted
     * @return Rga
     */
    public function setIsDeleted(VO\IsDeleted $isDeleted): Rga
    {
        $this->isDeleted = $isDeleted;
        
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function packageSent(): bool
    {
        return (bool)$this->packageSent->toString();
    }
    
    /**
     * @return VO\PackageSent
     */
    public function getPackageSent(): VO\PackageSent
    {
        return $this->packageSent;
    }
    
    /**
     * @param VO\PackageSent $packageSent
     * @return Rga
     */
    public function setPackageSent(VO\PackageSent $packageSent): Rga
    {
        $this->packageSent = $packageSent;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function packageNo(): string
    {
        return $this->packageNo->toString();
    }
    
    /**
     * @return VO\PackageNo
     */
    public function getPackageNo(): VO\PackageNo
    {
        return $this->packageNo;
    }
    
    /**
     * @param VO\PackageNo $packageNo
     * @return Rga
     */
    public function setPackageNo(VO\PackageNo $packageNo): Rga
    {
        $this->packageNo = $packageNo;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function packageSentAt(): string
    {
        return $this->packageSentAt->toString();
    }
    
    /**
     * @return VO\PackageSentAt
     */
    public function getPackageSentAt(): VO\PackageSentAt
    {
        return $this->packageSentAt;
    }
    
    /**
     * @param VO\PackageSentAt $packageSentAt
     * @return Rga
     */
    public function setPackageSentAt(VO\PackageSentAt $packageSentAt): Rga
    {
        $this->packageSentAt = $packageSentAt;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function individualNumber(): string
    {
        return $this->individualNumber->toString();
    }
    
    /**
     * @return VO\IndividualNumber
     */
    public function getIndividualNumber(): VO\IndividualNumber
    {
        return $this->individualNumber;
    }
    
    /**
     * @param VO\IndividualNumber $individualNumber
     * @return Rga
     */
    public function setIndividualNumber(VO\IndividualNumber $individualNumber): Rga
    {
        $this->individualNumber = $individualNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function hash(): string
    {
        return $this->hash->toString();
    }
    
    /**
     * @return VO\Hash
     */
    public function getHash(): VO\Hash
    {
        return $this->hash;
    }
    
    /**
     * @param VO\Hash $hash
     * @return Rga
     */
    public function setHash(VO\Hash $hash): Rga
    {
        $this->hash = $hash;
        
        return $this;
    }
}
