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
    private $sourceItemQuantity;

    public function __construct(
        int $id,
        int $variantId,
        string $name,
        bool $isRgaAble,
        ?int $finalDateOfComplaint,
        ?int $finalDateOfReturn,
        ?int $warranty,
        ?float $sourceItemQuantity
    ) {
        $this->id = $id;
        $this->variantId = $variantId;
        $this->name = $name;
        $this->isRgaAble = $isRgaAble;
        $this->finalDateOfComplaint = $finalDateOfComplaint;
        $this->finalDateOfReturn = $finalDateOfReturn;
        $this->warranty = $warranty;
        $this->sourceItemQuantity = $sourceItemQuantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVariantId(): int
    {
        return $this->variantId;
    }

    public function isRgaAble(): bool
    {
        return $this->isRgaAble;
    }

    public function getFinalDateOfComplaint(): ?int
    {
        return $this->finalDateOfComplaint;
    }

    public function getFinalDateOfReturn(): ?int
    {
        return $this->finalDateOfReturn;
    }

    public function getWarranty(): ?int
    {
        return $this->warranty;
    }

    public function getSourceItemQuantity(): ?float
    {
        return $this->sourceItemQuantity;
    }
}
