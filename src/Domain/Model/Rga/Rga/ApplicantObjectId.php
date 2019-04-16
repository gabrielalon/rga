<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantObjectId
{
    /** @var integer */
    private $id;
    
    /**
     * @param integer $id
     * @return ApplicantObjectId
     */
    public static function fromInteger(int $id): ApplicantObjectId
    {
        return new ApplicantObjectId($id);
    }
    
    /**
     * @param integer $id
     */
    private function __construct(int $id)
    {
        Assertion::integer($id, 'Invalid ApplicantObjectId integer: ' . $id);
        
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
     * @param ApplicantObjectId $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantObjectId) {
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
