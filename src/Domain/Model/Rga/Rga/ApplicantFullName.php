<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantFullName
{
    /** @var string */
    private $fullName;
    
    /**
     * @param string $fullName
     * @return ApplicantFullName
     */
    public static function fromString(string $fullName): ApplicantFullName
    {
        return new ApplicantFullName($fullName);
    }
    
    /**
     * @param string $fullName
     */
    private function __construct(string $fullName)
    {
        Assertion::string($fullName, 'Invalid ApplicantFullName string: ' . $fullName);
        
        $this->fullName = $fullName;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->fullName;
    }
    
    /**
     * @param ApplicantFullName $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantFullName) {
            return false;
        }
        
        return $this->fullName === $other->fullName;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->fullName;
    }
}
