<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantCountryId
{
    /** @var string */
    private $countryId;
    
    /**
     * @param integer $countryId
     * @return ApplicantCountryId
     */
    public static function fromInteger(int $countryId): ApplicantCountryId
    {
        return new ApplicantCountryId($countryId);
    }
    
    /**
     * @param integer $countryId
     */
    private function __construct(int $countryId)
    {
        Assertion::integer($countryId, 'Invalid ApplicantCountryId string: ' . $countryId);
        
        $this->countryId = $countryId;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->countryId;
    }
    
    /**
     * @param ApplicantCountryId $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantCountryId) {
            return false;
        }
        
        return $this->countryId === $other->countryId;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->countryId;
    }
}
