<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class CreatedAt
{
    /** @var string */
    private $date;
    
    /**
     * @param string $date
     * @return CreatedAt
     */
    public static function fromString(string $date): CreatedAt
    {
        return new CreatedAt($date);
    }
    
    /**
     * @param string $date
     */
    private function __construct(string $date)
    {
        Assertion::date($date, 'Y-m-d H:i:s', 'Invalid CreatedAt string: ' . $date);
        
        $this->date = $date;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->date;
    }
    
    /**
     * @param CreatedAt $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof CreatedAt) {
            return false;
        }
        
        return $this->date === $other->date;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->date;
    }
}
