<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ProductName
{
    /** @var string */
    private $name;
    
    /**
     * @param string $name
     * @return ProductName
     */
    public static function fromString(string $name): ProductName
    {
        return new ProductName($name);
    }
    
    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        Assertion::string($name, 'Invalid ProductName string: ' . $name);
        
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->name;
    }
    
    /**
     * @param ProductName $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof ProductName) {
            return false;
        }
        
        return $this->name === $other->name;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
