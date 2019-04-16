<?php

namespace RGA\Application\Assert\Exception;

class AssertionFailedException extends \InvalidArgumentException implements AssertionFailedExceptionInterface
{
    /** @var string */
    private $propertyPath;
    
    /** @var mixed */
    private $value;
    
    /** @var array */
    private $constraints;
    
    /**
     * @param string $message
     * @param integer $code
     * @param string $propertyPath
     * @param mixed $value
     * @param array $constraints
     */
    public function __construct($message, $code, $propertyPath, $value, array $constraints = [])
    {
        parent::__construct($message, $code);
        
        $this->propertyPath = $propertyPath;
        $this->value = $value;
        $this->constraints = $constraints;
    }
    
    /**
     * @return string
     */
    public function getPropertyPath()
    {
        return $this->propertyPath;
    }
    
    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @return array
     */
    public function getConstraints()
    {
        return $this->constraints;
    }
}
