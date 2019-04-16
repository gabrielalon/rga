<?php

namespace RGA\Application\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class NewRgaCreated extends Aggregate\EventBridge\AggregateChanged
{
    /**
     * @return Rga\Uuid
     */
    public function rgaUuid(): Rga\Uuid
    {
        return Rga\Uuid::fromString($this->aggregateId());
    }
    
    /**
     * @return Rga\CreatedAt
     */
    public function rgaCreatedAt(): Rga\CreatedAt
    {
        return Rga\CreatedAt::fromString((string)($this->payload['created_at'] ?? date('Y-m-d H:i:s')));
    }
    
    /**
     * @return Rga\BehaviourUuid
     */
    public function rgaBehaviourUuid(): Rga\BehaviourUuid
    {
        return Rga\BehaviourUuid::fromString((string)($this->payload['behaviour_uuid'] ?? ''));
    }
    
    /**
     * @return Rga\StateUuid
     */
    public function rgaStateUuid(): Rga\StateUuid
    {
        return Rga\StateUuid::fromString((string)($this->payload['state_uuid'] ?? ''));
    }
    
    /**
     * @return Rga\TransportUuid
     */
    public function rgaTransportUuid(): Rga\TransportUuid
    {
        return Rga\TransportUuid::fromString((string)($this->payload['transport_uuid'] ?? ''));
    }
    
    /**
     * @return Rga\SourceObjectType
     */
    public function rgaSourceObjectType(): Rga\SourceObjectType
    {
        return Rga\SourceObjectType::fromString((string)($this->payload['source_object_type'] ?? ''));
    }
    
    /**
     * @return Rga\SourceObjectId
     */
    public function rgaSourceObjectId(): Rga\SourceObjectId
    {
        return Rga\SourceObjectId::fromInteger((integer)($this->payload['source_object_id'] ?? ''));
    }
    
    /**
     * @return Rga\SourceObjectItemId
     */
    public function rgaSourceObjectItemId(): Rga\SourceObjectItemId
    {
        return Rga\SourceObjectItemId::fromInteger((integer)($this->payload['source_object_item_id'] ?? ''));
    }
    
    /**
     * @return Rga\SourceDateOfCreation
     */
    public function rgaSourceDateOfCreation(): Rga\SourceDateOfCreation
    {
        return Rga\SourceDateOfCreation::fromString((string)($this->payload['source_date_of_creation'] ?? ''));
    }
    
    /**
     * @return Rga\ProductName
     */
    public function rgaProductName(): Rga\ProductName
    {
        return Rga\ProductName::fromString((string)($this->payload['product_name'] ?? ''));
    }
    
    /**
     * @return Rga\ProductVariantId
     */
    public function rgaProductVariantId(): Rga\ProductVariantId
    {
        return Rga\ProductVariantId::fromInteger((integer)($this->payload['product_variant_id'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantGivenSourceObjectId
     */
    public function rgaApplicantGivenSourceObjectId(): Rga\ApplicantGivenSourceObjectId
    {
        return Rga\ApplicantGivenSourceObjectId::fromString((string)($this->payload['applicant_given_source_object_id'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantGivenSourceIdentification
     */
    public function rgaApplicantGivenSourceIdentification(): Rga\ApplicantGivenSourceIdentification
    {
        return Rga\ApplicantGivenSourceIdentification::fromString((string)($this->payload['applicant_given_source_identification'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantGivenProductName
     */
    public function rgaApplicantGivenProductName(): Rga\ApplicantGivenProductName
    {
        return Rga\ApplicantGivenProductName::fromString((string)($this->payload['applicant_given_product_name'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantReasons
     */
    public function rgaApplicantReasons(): Rga\ApplicantReasons
    {
        return Rga\ApplicantReasons::fromString((string)($this->payload['applicant_reasons'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantExpectations
     */
    public function rgaApplicantExpectations(): Rga\ApplicantExpectations
    {
        return Rga\ApplicantExpectations::fromString((string)($this->payload['applicant_expectations'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantDescriptionOfIncident
     */
    public function rgaApplicantDescriptionOfIncident(): Rga\ApplicantDescriptionOfIncident
    {
        return Rga\ApplicantDescriptionOfIncident::fromString((string)($this->payload['applicant_description_of_incident'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantObjectType
     */
    public function rgaApplicantObjectType(): Rga\ApplicantObjectType
    {
        return Rga\ApplicantObjectType::fromString((string)($this->payload['applicant_object_type'] ?? ''));
    }
    
    /**
     * @return Rga\ApplicantObjectId
     */
    public function rgaApplicantObjectId(): Rga\ApplicantObjectId
    {
        return Rga\ApplicantObjectId::fromInteger((integer)($this->payload['applicant_object_id'] ?? ''));
    }
    
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
     * @return ValueObject\PackageNo
     */
    public function rgaPackageNo(): ValueObject\PackageNo
    {
        return ValueObject\PackageNo::fromString((string)($this->payload['package_no'] ?? ''));
    }
    
    /**
     * @param AggregateRoot|Rga $rga
     */
    public function populate(AggregateRoot $rga): void
    {
        $rga->setUuid($this->rgaUuid());
        
        $rga->setCreatedAt($this->rgaCreatedAt());
        
        $rga->setBehaviourUuid($this->rgaBehaviourUuid());
        $rga->setStateUuid($this->rgaStateUuid());
        $rga->setTransportUuid($this->rgaTransportUuid());
        
        $rga->setSourceObjectType($this->rgaSourceObjectType());
        $rga->setSourceObjectId($this->rgaSourceObjectId());
        $rga->setSourceObjectItemId($this->rgaSourceObjectItemId());
        $rga->setSourceDateOfCreation($this->rgaSourceDateOfCreation());
        
        $rga->setProductName($this->rgaProductName());
        $rga->setProductVariantId($this->rgaProductVariantId());
        
        $rga->setApplicantGivenSourceObjectId($this->rgaApplicantGivenSourceObjectId());
        $rga->setApplicantGivenSourceIdentification($this->rgaApplicantGivenSourceIdentification());
        $rga->setApplicantGivenProductName($this->rgaApplicantGivenProductName());
        
        $rga->setApplicantReasons($this->rgaApplicantReasons());
        $rga->setApplicantExpectations($this->rgaApplicantExpectations());
        $rga->setApplicantDescriptionOfIncident($this->rgaApplicantDescriptionOfIncident());
        
        $rga->setApplicantObjectType($this->rgaApplicantObjectType());
        $rga->setApplicantObjectId($this->rgaApplicantObjectId());
        
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
        
        $rga->setAdminNotes(Rga\AdminNotes::fromString(''));
        $rga->setAdminNotesForApplicant(Rga\AdminNotesForApplicant::fromString(''));
        
        $rga->setIsProductReceived(Rga\IsProductReceived::fromBoolean(false));
        $rga->setIsCashReturned(Rga\IsCashReturned::fromBoolean(false));
        $rga->setIsProductReturned(Rga\IsProductReturned::fromBoolean(false));
        $rga->setIsDeleted(Rga\IsDeleted::fromBoolean(false));
        
        $rga->setPackageNo($this->rgaPackageNo());
        $rga->setPackageSent(Rga\PackageSent::fromBoolean(false));
    }
}
