<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Application\Assert\Assertion;

final class ShipmentId
{
    /** @var integer */
    private $id;
    
    /**
     * @param integer $id
     * @return ShipmentId
     */
    public static function fromInteger(int $id): ShipmentId
    {
        return new ShipmentId($id);
    }
    
    /**
     * @param integer $id
     */
    private function __construct(int $id)
    {
        Assertion::integer($id, 'Invalid ShipmentId integer: ' . $id);
        
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param ShipmentId $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ShipmentId) {
            return false;
        }
        
        return $this->id === $other->id;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->id;
    }
}
