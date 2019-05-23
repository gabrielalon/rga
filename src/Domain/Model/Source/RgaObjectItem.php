<?php

namespace RGA\Domain\Model\Source;

use RGA\Infrastructure\Source\RgaObject\RgaObjectItemInterface;

class RgaObjectItem implements RgaObjectItemInterface
{
    /** @var integer */
    private $id;
    
    /** @var integer */
    private $variantId;
    
    /** @var string */
    private $name;
    
    /** @var boolean */
    private $isRgaAble;
    
    /** @var integer|null */
    private $finalDateOfComplaint;
    
    /** @var integer|null */
    private $finalDateOfReturn;
    
    /** @var integer|null */
    private $warranty;

    /** @var null|float */
    private $quantity;

    public function __construct(
        int $id,
        int $variantId,
        string $name,
        bool $isRgaAble,
        ?int $finalDateOfComplaint,
        ?int $finalDateOfReturn,
        ?int $warranty,
        ?float $quantity
    ) {
        $this->id = $id;
        $this->variantId = $variantId;
        $this->name = $name;
        $this->isRgaAble = $isRgaAble;
        $this->finalDateOfComplaint = $finalDateOfComplaint;
        $this->finalDateOfReturn = $finalDateOfReturn;
        $this->warranty = $warranty;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return integer
     */
    public function getVariantId(): int
    {
        return $this->variantId;
    }
    
    /**
     * @return boolean
     */
    public function isRgaAble(): bool
    {
        return $this->isRgaAble;
    }
    
    /**
     * @return int
     */
    public function getFinalDateOfComplaint(): ?int
    {
        return $this->finalDateOfComplaint;
    }
    
    /**
     * @return int
     */
    public function getFinalDateOfReturn(): ?int
    {
        return $this->finalDateOfReturn;
    }
    
    /**
     * @return int|null
     */
    public function getWarranty(): ?int
    {
        return $this->warranty;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }
}
