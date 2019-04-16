<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantPostalCode
{
    /** @var string */
    private $postalCode;
    
    /**
     * @param string $postalCode
     * @return ApplicantPostalCode
     */
    public static function fromString(string $postalCode): ApplicantPostalCode
    {
        return new ApplicantPostalCode($postalCode);
    }
    
    /**
     * @param string $postalCode
     */
    private function __construct(string $postalCode)
    {
        Assertion::string($postalCode, 'Invalid ApplicantPostalCode string: ' . $postalCode);
        
        $this->postalCode = $postalCode;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->postalCode;
    }
    
    /**
     * @param ApplicantPostalCode $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantPostalCode) {
            return false;
        }
        
        return $this->postalCode === $other->postalCode;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->postalCode;
    }
}
