<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ModifiedAt
{
    /** @var string */
    private $date;
    
    /**
     * @param string $date
     * @return ModifiedAt
     */
    public static function fromString(string $date): ModifiedAt
    {
        return new ModifiedAt($date);
    }
    
    /**
     * @param string $date
     */
    private function __construct(string $date)
    {
        Assertion::date($date, 'Y-m-d H:i:s', 'Invalid ModifiedAt string: ' . $date);
        
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
     * @param ModifiedAt $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ModifiedAt) {
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
