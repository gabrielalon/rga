<?php

namespace RGA\Application\DI\PhpDi;

class ContainerBuilder extends \RGA\Infrastructure\DI\ContainerBuilder
{
    
    /**
     * Method should build di definition (object, callable or DI specific class
     *
     * @param  mixed $value
     * @return mixed
     */
    protected function buildDefinition($value)
    {
        if (true === is_string($value) && true === class_exists($value)) {
            return \DI\autowire($value);
        }
        
        if (true === is_object($value) || true === is_callable($value)) {
            return $value;
        }
        
        return $value;
    }
}
