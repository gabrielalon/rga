<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class Id
{
    /** @var integer */
    private $id;
    
    /**
     * @param integer $id
     * @return Id
     */
    public static function fromInteger(int $id): Id
    {
        return new Id($id);
    }
    
    /**
     * @param integer $id
     */
    private function __construct(int $id)
    {
        Assertion::integer($id, 'Invalid Id integer: ' . $id);
        
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
     * @param Id $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Id) {
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
