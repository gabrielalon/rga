<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class Responsible
{
    /** @var string */
    private $responsible;
    
    /**
     * @param string $responsible
     * @return Responsible
     */
    public static function fromString(string $responsible): Responsible
    {
        return new Responsible($responsible);
    }
    
    /**
     * @param string $responsible
     */
    private function __construct(string $responsible)
    {
        Assertion::string($responsible, 'Invalid Responsible string: ' . $responsible);
        
        $this->responsible = $responsible;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->responsible;
    }
    
    /**
     * @param Responsible $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Responsible) {
            return false;
        }
        
        return $this->responsible === $other->responsible;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->responsible;
    }
}
