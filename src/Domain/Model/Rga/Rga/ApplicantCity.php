<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantCity
{
    /** @var string */
    private $city;
    
    /**
     * @param string $city
     * @return ApplicantCity
     */
    public static function fromString(string $city): ApplicantCity
    {
        return new ApplicantCity($city);
    }
    
    /**
     * @param string $city
     */
    private function __construct(string $city)
    {
        Assertion::string($city, 'Invalid ApplicantCity string: ' . $city);
        
        $this->city = $city;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->city;
    }
    
    /**
     * @param ApplicantCity $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantCity) {
            return false;
        }
        
        return $this->city === $other->city;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->city;
    }
}
