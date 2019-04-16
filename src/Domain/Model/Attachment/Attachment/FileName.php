<?php

namespace RGA\Domain\Model\Attachment\Attachment;

use RGA\Application\Assert\Assertion;

final class FileName
{
    /** @var string */
    private $fileName;
    
    /**
     * @param string $fileName
     * @return FileName
     */
    public static function fromString(string $fileName): FileName
    {
        return new FileName($fileName);
    }
    
    /**
     * @param string $fileName
     */
    private function __construct(string $fileName)
    {
        Assertion::string($fileName, 'Invalid FileName string: ' . $fileName);
        
        $this->fileName = $fileName;
    }
    
    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }
    
    /**
     * @param FileName $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof FileName) {
            return false;
        }
        
        return $this->fileName === $other->fileName;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->fileName;
    }
}
