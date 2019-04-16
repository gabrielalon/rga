<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantTelephone
{
    /** @var string */
    private $telephone;
    
    /**
     * @param string $telephone
     * @return ApplicantTelephone
     */
    public static function fromString(string $telephone): ApplicantTelephone
    {
        return new ApplicantTelephone($telephone);
    }
    
    /**
     * @param string $telephone
     */
    private function __construct(string $telephone)
    {
        Assertion::string($telephone, 'Invalid Applicant telephone: ' . $telephone);
        
        $this->telephone = $telephone;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->telephone;
    }
    
    /**
     * @param ApplicantTelephone $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantTelephone) {
            return false;
        }
        
        return $this->telephone === $other->telephone;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->telephone;
    }
}
