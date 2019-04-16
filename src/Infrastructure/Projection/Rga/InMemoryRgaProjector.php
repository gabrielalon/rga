<?php

namespace RGA\Infrastructure\Projection\Rga;

use RGA\Application\Rga\Event;
use RGA\Application\Rga\Query\ReadModel;
use RGA\Domain\Model\Rga\Projection\RgaProjectorInterface;
use RGA\Domain\Model\Rga\Rga as ValueObject;

class InMemoryRgaProjector implements RgaProjectorInterface
{
    /** @var ReadModel\Rga[] */
    private $rgas = [];
    
    /**
     * @param Event\ApplicantRgaChanged $event
     */
    public function onApplicantRgaChanged(Event\ApplicantRgaChanged $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setApplicantContactPreference($event->rgaApplicantContactPreference())
            ->setApplicantEmail($event->rgaApplicantEmail())
            ->setApplicantTelephone($event->rgaApplicantTelephone())
            
            ->setApplicantFullName($event->rgaApplicantFullName())
            ->setApplicantStreetName($event->rgaApplicantStreetName())
            ->setApplicantBuildingNumber($event->rgaApplicantBuildingNumber())
            ->setApplicantApartmentNumber($event->rgaApplicantApartmentNumber())
            ->setApplicantPostalCode($event->rgaApplicantPostalCode())
            ->setApplicantCity($event->rgaApplicantCity())
            ->setApplicantCountryCode($event->rgaApplicantCountryCode())
            
            ->setApplicantBankAccountNumber($event->rgaApplicantBankAccountNumber())
            ->setApplicantBankName($event->rgaApplicantBankName());
    }
    
    /**
     * @param Event\ExistingRgaRemoved $event
     */
    public function onExistingRgaRemoved(Event\ExistingRgaRemoved $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setIsDeleted(ValueObject\IsDeleted::fromBoolean(true));
    }
    
    /**
     * @param Event\FlagsRgaChanged $event
     */
    public function onFlagsRgaChanged(Event\FlagsRgaChanged $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setAdminNotesForApplicant($event->rgaAdminNotesForApplicant())
            
            ->setIsProductReturned($event->rgaIsProductReturned())
            ->setIsProductReceived($event->rgaIsProductReceived())
            ->setIsCashReturned($event->rgaIsCashReturned());
    }
    
    /**
     * @param Event\NoteRgaChanged $event
     */
    public function onNoteRgaChanged(Event\NoteRgaChanged $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setAdminNotes($event->rgaAdminNotes());
    }
    
    /**
     * @param Event\NewRgaCreated $event
     */
    public function onNewRgaCreated(Event\NewRgaCreated $event): void
    {
        $this->rgas[$event->rgaUuid()->toString()] = ReadModel\Rga::fromUuid($event->rgaUuid())
            ->setCreatedAt($event->rgaCreatedAt())
            
            ->setBehaviourUuid($event->rgaBehaviourUuid())
            ->setStateUuid($event->rgaStateUuid())
            ->setTransportUuid($event->rgaTransportUuid())
            
            ->setSourceObjectType($event->rgaSourceObjectType())
            ->setSourceObjectId($event->rgaSourceObjectId())
            ->setSourceObjectItemId($event->rgaSourceObjectItemId())
            ->setSourceDateOfCreation($event->rgaSourceDateOfCreation())
            
            ->setProductName($event->rgaProductName())
            ->setProductVariantId($event->rgaProductVariantId())
            
            ->setApplicantGivenSourceObjectId($event->rgaApplicantGivenSourceObjectId())
            ->setApplicantGivenSourceIdentification($event->rgaApplicantGivenSourceIdentification())
            ->setApplicantGivenProductName($event->rgaApplicantGivenProductName())
            
            ->setApplicantReasons($event->rgaApplicantReasons())
            ->setApplicantExpectations($event->rgaApplicantExpectations())
            ->setApplicantDescriptionOfIncident($event->rgaApplicantDescriptionOfIncident())
            
            ->setApplicantObjectType($event->rgaApplicantObjectType())
            ->setApplicantObjectId($event->rgaApplicantObjectId())
            
            ->setApplicantContactPreference($event->rgaApplicantContactPreference())
            ->setApplicantEmail($event->rgaApplicantEmail())
            ->setApplicantTelephone($event->rgaApplicantTelephone())
            
            ->setApplicantFullName($event->rgaApplicantFullName())
            ->setApplicantStreetName($event->rgaApplicantStreetName())
            ->setApplicantBuildingNumber($event->rgaApplicantBuildingNumber())
            ->setApplicantApartmentNumber($event->rgaApplicantApartmentNumber())
            ->setApplicantPostalCode($event->rgaApplicantPostalCode())
            ->setApplicantCity($event->rgaApplicantCity())
            ->setApplicantCountryCode($event->rgaApplicantCountryCode())
            
            ->setApplicantBankAccountNumber($event->rgaApplicantBankAccountNumber())
            ->setApplicantBankName($event->rgaApplicantBankName())
            
            ->setAdminNotes(ValueObject\AdminNotes::fromString(''))
            ->setAdminNotesForApplicant(ValueObject\AdminNotesForApplicant::fromString(''))
            
            ->setIsProductReceived(ValueObject\IsProductReceived::fromBoolean(false))
            ->setIsCashReturned(ValueObject\IsCashReturned::fromBoolean(false))
            ->setIsProductReturned(ValueObject\IsProductReturned::fromBoolean(false))
            ->setIsDeleted(ValueObject\IsDeleted::fromBoolean(false))
            
            ->setPackageNo($event->rgaPackageNo())
            ->setPackageSent(ValueObject\PackageSent::fromBoolean(false));
    }
    
    /**
     * @param Event\PackageRgaSet $event
     */
    public function onPackageRgaSet(Event\PackageRgaSet $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setPackageNo($event->rgaPackageNo())
            ->setPackageSentAt($event->rgaPackageSentAt());
    }
    
    /**
     * @param Event\StateRgaChanged $event
     */
    public function onStateRgaChanged(Event\StateRgaChanged $event): void
    {
        $this->rgas[$event->aggregateId()] = $this->get($event->aggregateId())
            ->setStateUuid($event->rgaStateUuid());
    }
    
    /**
     * @param string $uuid
     * @return ReadModel\Rga
     */
    public function get(string $uuid): ReadModel\Rga
    {
        if (false === isset($this->rgas[$uuid])) {
            throw new \RuntimeException('Rga entity not found for uuid: ' . $uuid);
        }
        
        return $this->rgas[$uuid];
    }
}
