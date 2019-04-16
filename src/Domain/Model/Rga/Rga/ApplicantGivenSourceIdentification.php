<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantGivenSourceIdentification
{
    /** @var string */
    private $givenIdentification;
    
    /**
     * @param string $givenIdentification
     * @return ApplicantGivenSourceIdentification
     */
    public static function fromString(string $givenIdentification): ApplicantGivenSourceIdentification
    {
        return new ApplicantGivenSourceIdentification($givenIdentification);
    }
    
    /**
     * @param string $givenIdentification
     */
    private function __construct(string $givenIdentification)
    {
        Assertion::string($givenIdentification, 'Invalid ApplicantGivenSourceIdentification string: ' . $givenIdentification);
        
        $this->givenIdentification = $givenIdentification;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->givenIdentification;
    }
    
    /**
     * @param ApplicantGivenSourceIdentification $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantGivenSourceIdentification) {
            return false;
        }
        
        return $this->givenIdentification === $other->givenIdentification;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->givenIdentification;
    }
}
