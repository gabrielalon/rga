<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantApartmentNumber
{
    /** @var string */
    private $apartmentNumber;
    
    /**
     * @param string $apartmentNumber
     * @return ApplicantApartmentNumber
     */
    public static function fromString(string $apartmentNumber): ApplicantApartmentNumber
    {
        return new ApplicantApartmentNumber($apartmentNumber);
    }
    
    /**
     * @param string $apartmentNumber
     */
    private function __construct(string $apartmentNumber)
    {
        Assertion::string($apartmentNumber, 'Invalid ApplicantApartmentNumber string: ' . $apartmentNumber);
        
        $this->apartmentNumber = $apartmentNumber;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->apartmentNumber;
    }
    
    /**
     * @param ApplicantApartmentNumber $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantApartmentNumber) {
            return false;
        }
        
        return $this->apartmentNumber === $other->apartmentNumber;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->apartmentNumber;
    }
}
