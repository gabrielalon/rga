<?php

namespace RGA\Domain\Model\Source;

class RgaObjectItemBuilder
{
    /** @var integer */
    private $id;
    
    /** @var integer */
    private $variantId;
    
    /** @var string */
    private $objectName;
    
    /** @var boolean */
    private $isRgaAble;
    
    /** @var integer|null */
    private $finalDateOfComplaint = null;
    
    /** @var integer|null */
    private $finalDateOfReturn = null;
    
    /** @var integer|null */
    private $warranty = null;

    /** @var null|float  */
    private $quantity = null;

    /**
     * @param int $id
     * @param int $variantId
     * @param string $objectName
     * @param bool $isRgaAble
     */
    public function __construct($id, $variantId, $objectName, $isRgaAble = true)
    {
        $this->id = $id;
        $this->variantId = $variantId;
        $this->objectName = $objectName;
        $this->isRgaAble = $isRgaAble;
    }

    /**
     * @param int|null $finalDateOfComplaint
     * @return RgaObjectItemBuilder
     */
    public function setFinalDateOfComplaint(?int $finalDateOfComplaint): RgaObjectItemBuilder
    {
        $this->finalDateOfComplaint = $finalDateOfComplaint;
        
        return $this;
    }
    
    /**
     * @param int|null $finalDateOfReturn
     * @return RgaObjectItemBuilder
     */
    public function setFinalDateOfReturn(?int $finalDateOfReturn): RgaObjectItemBuilder
    {
        $this->finalDateOfReturn = $finalDateOfReturn;
        
        return $this;
    }
    
    /**
     * @param int|null $warranty
     * @return RgaObjectItemBuilder
     */
    public function setWarranty(?int $warranty): RgaObjectItemBuilder
    {
        $this->warranty = $warranty;
        
        return $this;
    }

    public function setQuantity(?float $quantity): RgaObjectItemBuilder
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return RgaObjectItem
     */
    public function build(): RgaObjectItem
    {
        return new RgaObjectItem(
            $this->id,
            $this->variantId,
            $this->objectName,
            $this->isRgaAble,
            $this->finalDateOfComplaint,
            $this->finalDateOfReturn,
            $this->warranty,
            $this->quantity
        );
    }
}
