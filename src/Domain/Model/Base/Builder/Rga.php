<?php

namespace RGA\Domain\Model\Base\Builder;

use RGA\Domain\Model\Attachment\AttachmentCollection;
use RGA\Domain\Model\Attachment\Builder\Attachment;
use RGA\Domain\Model\Base\Rga as Entity;
use RGA\Domain\ValueObject;

class Rga
{
	/** @var Entity */
	private $entity;
	
	/**
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}
	
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	public static function init($uuid): Rga
	{
		$entity = new Entity();
		$entity->setUuid($uuid);
		$entity->setCreatedAt(new ValueObject\Base\CreatedAt('now'));
		$entity->setIsDeleted(new ValueObject\Base\IsDeleted(false));
		
		return new Rga($entity);
	}
	
	public function markDeleted(): void
	{
		$this->entity->setIsDeleted(new ValueObject\Base\IsDeleted(true));
	}
	
	/**
	 * @param ValueObject\Applicant\Applicant $applicant
	 */
	public function setApplicant(ValueObject\Applicant\Applicant $applicant): void
	{
		$this->entity->setApplicantObjectType(new ValueObject\Base\ApplicantObjectType($applicant->getType()));
		$this->entity->setApplicantObjectID(new ValueObject\Base\ApplicantObjectID($applicant->getId()));
	}
	
	/**
	 * @param ValueObject\Applicant\Contact $contact
	 */
	public function setContact(ValueObject\Applicant\Contact $contact): void
	{
		$this->entity->setApplicantEmail(new ValueObject\Base\ApplicantEmail($contact->getEmail()));
		$this->entity->setApplicantTelephone(new ValueObject\Base\ApplicantTelephone($contact->getTelephone()));
		$this->entity->setApplicantContactPreference(new ValueObject\Base\ApplicantContactPreference($contact->getPreferredForm()));
	}
	
	/**
	 * @param ValueObject\Applicant\Address $address
	 */
	public function setAddress(ValueObject\Applicant\Address $address): void
	{
		$this->entity->setApplicantFullName(new ValueObject\Base\ApplicantFullName($address->getFullName()));
		$this->entity->setApplicantStreetName(new ValueObject\Base\ApplicantStreetName($address->getStreetName()));
		$this->entity->setApplicantBuildingNumber(new ValueObject\Base\ApplicantBuildingNumber($address->getBuildingNumber()));
		$this->entity->setApplicantApartmentNumber(new ValueObject\Base\ApplicantApartmentNumber($address->getApartmentNumber()));
		$this->entity->setApplicantPostalCode(new ValueObject\Base\ApplicantPostalCode($address->getPostalCode()));
		$this->entity->setApplicantCity(new ValueObject\Base\ApplicantCity($address->getCity()));
		$this->entity->setApplicantCountryCode(new ValueObject\Base\ApplicantCountryCode($address->getCountryCode()));
	}
	
	/**
	 * @param string $notes
	 */
	public function setAdminNotes($notes): void
	{
		$this->entity->setAdminNotes(new ValueObject\Base\AdminNotes($notes));
	}
	
	/**
	 * @param string $notes
	 */
	public function setAdminNotesForApplicant($notes): void
	{
		$this->entity->setAdminNotesForApplicant(new ValueObject\Base\AdminNotesForApplicant($notes));
	}
	
	/**
	 * @param ValueObject\Applicant\Bank $bank
	 */
	public function setBank(ValueObject\Applicant\Bank $bank): void
	{
		$this->entity->setApplicantBankName(new ValueObject\Base\ApplicantBankName($bank->getName()));
		$this->entity->setApplicantBankAccountNumber(new ValueObject\Base\ApplicantBankAccountNumber($bank->getAccountNumber()));
	}
	
	/**
	 * @param ValueObject\Base\Reference $reference
	 */
	public function setReferences(ValueObject\Base\Reference $reference): void
	{
		$this->entity->setBehaviourUuid(new ValueObject\Base\BehaviourUuid($reference->getBehaviourUuid()));
		$this->entity->setStateUuid(new ValueObject\Base\StateUuid($reference->getStateUuid()));
		$this->entity->setTransportUuid(new ValueObject\Base\TransportUuid($reference->getTransportUuid()));
	}
	
	/**
	 * @param ValueObject\Base\ObjectItem $objectItem
	 */
	public function setObjectItem(ValueObject\Base\ObjectItem $objectItem): void
	{
		$this->entity->setSourceObjectID(new ValueObject\Base\SourceObjectID($objectItem->getSourceID()));
		$this->entity->setSourceObjectItemID(new ValueObject\Base\SourceObjectItemID($objectItem->getSourceItemID()));
		$this->entity->setSourceObjectType(new ValueObject\Base\SourceObjectType($objectItem->getSourceType()));
		$this->entity->setSourceDateOfCreation(new ValueObject\Base\SourceDateOfCreation($objectItem->getDateOfCreation()));
		
		$this->entity->setProductVariantID(new ValueObject\Base\ProductVariantID($objectItem->getVariantID()));
		$this->entity->setProductName(new ValueObject\Base\ProductName($objectItem->getProductName()));
		
		$this->entity->setApplicantExpectations(new ValueObject\Base\ApplicantExpectations($objectItem->getExpectation()));
		$this->entity->setApplicantGivenSourceObjectID(new ValueObject\Base\ApplicantGivenSourceObjectID($objectItem->getGivenSourceID()));
		$this->entity->setApplicantGivenSourceIdentification(new ValueObject\Base\ApplicantGivenSourceIdentification($objectItem->getGivenSourceID()));
		$this->entity->setApplicantGivenProductName(new ValueObject\Base\ApplicantGivenProductName($objectItem->getGivenName()));
		$this->entity->setApplicantReasons(new ValueObject\Base\ApplicantReasons($objectItem->getReason()));
		$this->entity->setApplicantDescriptionOfIncident(new ValueObject\Base\ApplicantDescriptionOfIncident($objectItem->getIncident()));
		
		$this->setAttachments($objectItem);
	}
	
	/**
	 * @param ValueObject\Base\ObjectItem $objectItem
	 */
	private function setAttachments(ValueObject\Base\ObjectItem $objectItem): void
	{
		$attachments = new AttachmentCollection();
		
		foreach ($objectItem->getAttachments() as $attachment)
		{
			$builder = Attachment::init($this->entity->getUuid());
			$builder->setAttachment($attachment);
			
			$attachments->add($builder->build());
		}
		
		$this->entity->setAttachments($attachments);
	}
	
	/**
	 * @param integer $group
	 * @param integer $individual
	 */
	public function setNumbers($group, $individual): void
	{
		$this->entity->setIndividualGroup(new ValueObject\Base\IndividualGroup($group));
		$this->entity->setIndividualNumber(new ValueObject\Base\IndividualNumber($individual));
	}
	
	/**
	 * @param boolean $isProductReceived
	 * @param boolean $isCashReturned
	 * @param boolean $isProductReturned
	 */
	public function setFlags($isProductReceived, $isCashReturned, $isProductReturned): void
	{
		$this->entity->setIsProductReceived(new ValueObject\Base\IsProductReceived($isProductReceived));
		$this->entity->setIsProductReturned(new ValueObject\Base\IsProductReturned($isProductReturned));
		$this->entity->setIsCashReturned(new ValueObject\Base\IsCashReturned($isCashReturned));
	}
	
	/**
	 * @param string $stateUuid
	 */
	public function setState($stateUuid): void
	{
		$this->entity->setStateUuid(new ValueObject\Base\StateUuid($stateUuid));
	}
	
	/**
	 * @return Entity
	 */
	public function build(): Entity
	{
		$this->entity->setModifiedAt(new ValueObject\Base\ModifiedAt('now'));
		
		return $this->entity;
	}
}