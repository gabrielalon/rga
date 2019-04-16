<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantStreetName
{
    /** @var string */
    private $streetName;
    
    /**
     * @param string $streetName
     * @return ApplicantStreetName
     */
    public static function fromString(string $streetName): ApplicantStreetName
    {
        return new ApplicantStreetName($streetName);
    }
    
    /**
     * @param string $streetName
     */
    private function __construct(string $streetName)
    {
        Assertion::string($streetName, 'Invalid ApplicantStreetName string: ' . $streetName);
        
        $this->streetName = $streetName;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->streetName;
    }
    
    /**
     * @param ApplicantStreetName $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantStreetName) {
            return false;
        }
        
        return $this->streetName === $other->streetName;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->streetName;
    }
}
