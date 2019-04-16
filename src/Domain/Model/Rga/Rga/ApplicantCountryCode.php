<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantCountryCode
{
    /** @var string */
    private $countryCode;
    
    /**
     * @param string $countryCode
     * @return ApplicantCountryCode
     */
    public static function fromString(string $countryCode): ApplicantCountryCode
    {
        return new ApplicantCountryCode($countryCode);
    }
    
    /**
     * @param string $countryCode
     */
    private function __construct(string $countryCode)
    {
        Assertion::string($countryCode, 'Invalid ApplicantCountryCode string: ' . $countryCode);
        
        $this->countryCode = $countryCode;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->countryCode;
    }
    
    /**
     * @param ApplicantCountryCode $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantCountryCode) {
            return false;
        }
        
        return $this->countryCode === $other->countryCode;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->countryCode;
    }
}
