<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantGivenProductName
{
    /** @var string */
    private $givenName;
    
    /**
     * @param string $givenName
     * @return ApplicantGivenProductName
     */
    public static function fromString(string $givenName): ApplicantGivenProductName
    {
        return new ApplicantGivenProductName($givenName);
    }
    
    /**
     * @param string $givenName
     */
    private function __construct(string $givenName)
    {
        Assertion::string($givenName, 'Invalid ApplicantGivenProductName string: ' . $givenName);
        
        $this->givenName = $givenName;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->givenName;
    }
    
    /**
     * @param ApplicantGivenProductName $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantGivenProductName) {
            return false;
        }
        
        return $this->givenName === $other->givenName;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->givenName;
    }
}
