<?php

namespace RGA\Infrastructure\Query\Rga;

use RGA\Application\Rga\Query;
use RGA\Domain\Model\Behaviour\Behaviour as VOBehaviour;
use RGA\Domain\Model\Rga\Rga as VO;

trait RgaQueryTrait
{
    /**
     * @param Query\ReadModel\RgaCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\RgaCollection $collection, \stdClass $row): void
    {
        if (true === $collection->has($row->uuid)) {
            $view = $collection->get($row->uuid)
                ->addBehaviourName($row->locale, $row->behaviour_name)
                ->addTransportName($row->locale, $row->transport_name)
                ->addStateName($row->locale, $row->state_name);
        } else {
            $view = Query\ReadModel\Rga::fromUuid($row->uuid)
                ->setCreatedAt(VO\CreatedAt::fromString((string)$row->created_at))
                ->setModifiedAt(VO\ModifiedAt::fromString((string)$row->modified_at))
                ->setStateUuid(VO\StateUuid::fromString((string)$row->state_uuid))
                ->addStateName($row->locale, $row->state_name)
                ->setBehaviourUuid(VO\BehaviourUuid::fromString((string)$row->behaviour_uuid))
                ->setBehaviourType(VOBehaviour\Type::fromString((string)$row->behaviour_type))
                ->addBehaviourName($row->locale, $row->behaviour_name)
                ->setTransportUuid(VO\TransportUuid::fromString((string)$row->transport_uuid))
                ->addTransportName($row->locale, $row->transport_name)
                ->setSourceObjectType(VO\SourceObjectType::fromString((string)$row->source_object_type))
                ->setSourceObjectId(VO\SourceObjectId::fromInteger((integer)$row->source_object_id))
                ->setSourceObjectItemId(VO\SourceObjectItemId::fromInteger((integer)$row->source_object_item_id))
                ->setSourceObjectItemQuantity(VO\SourceObjectItemQuantity::fromFloat((float)$row->source_object_item_quantity))
                ->setSourceDateOfCreation(VO\SourceDateOfCreation::fromString((string)$row->source_date_of_creation))
                ->setProductName(VO\ProductName::fromString((string)$row->product_name))
                ->setProductVariantId(VO\ProductVariantId::fromInteger((integer)$row->product_variant_id))
                ->setApplicantGivenSourceObjectId(VO\ApplicantGivenSourceObjectId::fromString((string)$row->applicant_given_source_object_id))
                ->setApplicantGivenProductName(VO\ApplicantGivenProductName::fromString((string)$row->applicant_given_product_name))
                ->setApplicantReasons(VO\ApplicantReasons::fromString((string)$row->applicant_reasons))
                ->setApplicantExpectations(VO\ApplicantExpectations::fromString((string)$row->applicant_expectations))
                ->setApplicantDescriptionOfIncident(VO\ApplicantDescriptionOfIncident::fromString((string)$row->applicant_descriptions_of_incident))
                ->setApplicantObjectType(VO\ApplicantObjectType::fromString((string)$row->applicant_object_type))
                ->setApplicantObjectId(VO\ApplicantObjectId::fromInteger((integer)$row->applicant_object_id))
                ->setApplicantContactPreference(VO\ApplicantContactPreference::fromString((string)$row->applicant_contact_preference))
                ->setApplicantEmail(VO\ApplicantEmail::fromString((string)$row->applicant_email))
                ->setApplicantTelephone(VO\ApplicantTelephone::fromString((string)$row->applicant_telephone))
                ->setApplicantFullName(VO\ApplicantFullName::fromString((string)$row->applicant_full_name))
                ->setApplicantStreetName(VO\ApplicantStreetName::fromString((string)$row->applicant_street_name))
                ->setApplicantBuildingNumber(VO\ApplicantBuildingNumber::fromString((string)$row->applicant_building_number))
                ->setApplicantApartmentNumber(VO\ApplicantApartmentNumber::fromString((string)$row->applicant_apartment_number))
                ->setApplicantPostalCode(VO\ApplicantPostalCode::fromString((string)$row->applicant_postal_code))
                ->setApplicantCity(VO\ApplicantCity::fromString((string)$row->applicant_city))
                ->setApplicantCountryId(VO\ApplicantCountryId::fromInteger((integer)$row->applicant_country_id))
                ->setApplicantCountryCode(VO\ApplicantCountryCode::fromString((string)$row->applicant_country_code))
                ->setApplicantBankAccountNumber(VO\ApplicantBankAccountNumber::fromString((string)$row->applicant_bank_account_number))
                ->setApplicantBankName(VO\ApplicantBankName::fromString((string)$row->applicant_bank_name))
                ->setAdminNotes(VO\AdminNotes::fromString((string)$row->admin_notes))
                ->setAdminNotesForApplicant(VO\AdminNotesForApplicant::fromString((string)$row->admin_notes_for_applicant))
                ->setIsProductReceived(VO\IsProductReceived::fromBoolean((boolean)$row->is_product_received))
                ->setIsCashReturned(VO\IsCashReturned::fromBoolean((boolean)$row->is_cash_returned))
                ->setIsProductReturned(VO\IsProductReturned::fromBoolean((boolean)$row->is_product_returned))
                ->setIsDeleted(VO\IsDeleted::fromBoolean((boolean)$row->is_deleted))
                ->setPackageSent(VO\PackageSent::fromBoolean((boolean)$row->package_sent))
                ->setHash(VO\Hash::fromString((string)$row->hash))
                ->setIndividualNumber(VO\IndividualNumber::fromInteger((integer)$row->individual_number));
        }
        
        if (true === $view->packageSent()) {
            $view
                ->setPackageNo(VO\PackageNo::fromString((string)$row->package_no))
                ->setPackageSentAt(VO\PackageSentAt::fromString((string)$row->package_sent_at));
        }
        
        $collection->add($view);
    }
}
