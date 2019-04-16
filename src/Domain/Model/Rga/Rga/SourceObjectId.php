<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class SourceObjectId
{
    /** @var integer */
    private $id;
    
    /**
     * @param integer $id
     * @return SourceObjectId
     */
    public static function fromInteger(int $id): SourceObjectId
    {
        return new SourceObjectId($id);
    }
    
    /**
     * @param integer $id
     */
    private function __construct(int $id)
    {
        Assertion::integer($id, 'Invalid SourceObjectId integer: ' . $id);
        
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->id;
    }
    
    /**
     * @param SourceObjectId $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof SourceObjectId) {
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
