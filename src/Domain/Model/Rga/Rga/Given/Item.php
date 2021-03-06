<?php

namespace RGA\Domain\Model\Rga\Rga\Given;

use RGA\Infrastructure\Source\RgaObject\RgaObjectItemInterface;

class Item implements RgaObjectItemInterface
{
    /** @var integer */
    private $sourceItemID;

    /** @var float|null */
    private $sourceItemQuantity;
    
    /** @var string */
    private $givenSourceID;
    
    /** @var string */
    private $givenName;
    
    /** @var string */
    private $reason;
    
    /** @var string */
    private $expectation;
    
    /** @var string */
    private $incident;
    
    /** @var Attachment[] */
    private $attachments = [];
    
    /** @var Additional[] */
    private $additionals = [];
    
    /** @var string */
    private $rgaUuid;

    public function __construct(
        int $sourceItemID,
        ?float $sourceItemQuantity,
        string $givenSourceID,
        string $givenName,
        string $reason,
        string $expectation,
        string $incident,
        array $attachments = [],
        array $additionals = [],
        string $rgaUuid = null
    ) {
        $this->sourceItemID = $sourceItemID;
        $this->sourceItemQuantity = $sourceItemQuantity;
        $this->givenSourceID = $givenSourceID;
        $this->givenName = $givenName;
        $this->reason = $reason;
        $this->expectation = $expectation;
        $this->incident = $incident;
        $this->attachments = $attachments;
        $this->additionals = $additionals;
        $this->rgaUuid = $rgaUuid;
    }
    
    /**
     * @return int
     */
    public function getSourceItemID(): int
    {
        return $this->sourceItemID;
    }

    public function getSourceItemQuantity(): ?float
    {
        return $this->sourceItemQuantity;
    }
    
    /**
     * @return string
     */
    public function getGivenSourceID(): string
    {
        return $this->givenSourceID;
    }
    
    /**
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->givenName;
    }
    
    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
    
    /**
     * @return string
     */
    public function getExpectation(): string
    {
        return $this->expectation;
    }
    
    /**
     * @return string
     */
    public function getIncident(): string
    {
        return $this->incident;
    }
    
    /**
     * @return Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
    
    /**
     * @return Additional[]
     */
    public function getAdditionals(): array
    {
        return $this->additionals;
    }
    
    /**
     * @return integer
     */
    public function getId(): int
    {
        return 0;
    }
    
    /**
     * @return integer
     */
    public function getVariantId(): int
    {
        return 0;
    }
    
    /**
     * @return boolean
     */
    public function isRgaAble(): bool
    {
        return true;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getGivenName();
    }
    
    /**
     * @return integer|null
     */
    public function getFinalDateOfComplaint(): ?int
    {
        return null;
    }
    
    /**
     * @return integer|null
     */
    public function getFinalDateOfReturn(): ?int
    {
        return null;
    }
    
    /**
     * @return integer|null
     */
    public function getWarranty(): ?int
    {
        return null;
    }
    
    /**
     * @param string $defaultUuid
     * @return string
     */
    public function getRgaUuid($defaultUuid): string
    {
        if (false === empty($this->rgaUuid) && $this->rgaUuid !== $defaultUuid) {
            return $this->rgaUuid;
        }
        
        return $defaultUuid;
    }
}
