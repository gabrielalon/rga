<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class SourceObjectItemId
{
    /** @var integer */
    private $id;
    
    /**
     * @param integer $id
     * @return SourceObjectItemId
     */
    public static function fromInteger(int $id): SourceObjectItemId
    {
        return new SourceObjectItemId($id);
    }
    
    /**
     * @param integer $id
     */
    private function __construct(int $id)
    {
        Assertion::integer($id, 'Invalid SourceObjectItemId integer: ' . $id);
        
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
     * @param SourceObjectItemId $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof SourceObjectItemId) {
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
