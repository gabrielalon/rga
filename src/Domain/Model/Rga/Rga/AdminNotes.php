<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class AdminNotes
{
    /** @var string */
    private $notes;
    
    /**
     * @param string $notes
     * @return AdminNotes
     */
    public static function fromString(string $notes): AdminNotes
    {
        return new AdminNotes($notes);
    }
    
    /**
     * @param string $notes
     */
    private function __construct(string $notes)
    {
        Assertion::string($notes, 'Invalid AdminNotes string: ' . $notes);
        
        $this->notes = $notes;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->notes;
    }
    
    /**
     * @param AdminNotes $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof AdminNotes) {
            return false;
        }
        
        return $this->notes === $other->notes;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->notes;
    }
}
