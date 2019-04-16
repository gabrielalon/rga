<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantReasons
{
    /** @var string */
    private $reasons;
    
    /**
     * @param string $reasons
     * @return ApplicantReasons
     */
    public static function fromString(string $reasons): ApplicantReasons
    {
        return new ApplicantReasons($reasons);
    }
    
    /**
     * @param string $reasons
     */
    private function __construct(string $reasons)
    {
        Assertion::string($reasons, 'Invalid ApplicantReasons string: ' . $reasons);
        
        $this->reasons = $reasons;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->reasons;
    }
    
    /**
     * @param ApplicantReasons $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ApplicantReasons) {
            return false;
        }
        
        return $this->reasons === $other->reasons;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->reasons;
    }
}
