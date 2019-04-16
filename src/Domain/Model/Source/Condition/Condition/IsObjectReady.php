<?php

namespace RGA\Domain\Model\Source\Condition\Condition;

use RGA\Application\Assert;
use RGA\Domain\Model;
use RGA\Infrastructure\Source;

class IsObjectReady extends Assert\Assertion
{
    const INVALID_IS_MET = 900;
    
    /** @var Model\Source\RgaObject */
    private $sourceObject;
    
    /**
     * @param Model\Source\RgaObject $object
     */
    public function __construct(Model\Source\RgaObject $object)
    {
        $this->sourceObject = $object;
    }
    
    /**
     * @return bool
     */
    public function isMet(): bool
    {
        $isCompleted = $this->sourceObject->hasCompletedState();
        $isPaid = $this->sourceObject->isPaid();
        
        return $isPaid && $isCompleted;
    }
    
    /**
     * @param Model\Source\RgaObject $source
     * @throws Assert\Exception\AssertionFailedException
     */
    public static function assert(Model\Source\RgaObject $source): void
    {
        $condition = new static($source);
        
        if (false === $condition->isMet()) {
            $message = static::generateMessage('Object is not ready to return');
            throw static::createException($source, $message, self::INVALID_IS_MET);
        }
    }
}
