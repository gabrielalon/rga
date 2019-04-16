<?php

namespace RGA\Application\Additional\Query\Decorator;

class DescriptionDecoratorRegistry
{
    /** @var DescriptionDecoratorInterface[] */
    private $collection = [];
    
    /**
     * @param DescriptionDecoratorInterface $decorator
     */
    public function register(DescriptionDecoratorInterface $decorator)
    {
        $this->collection[$decorator->getType()] = $decorator;
    }
    
    /**
     * @param string $type
     * @return DescriptionDecoratorInterface
     */
    public function get(string $type): DescriptionDecoratorInterface
    {
        if (true === isset($this->collection[$type])) {
            return $this->collection[$type];
        }
        
        return new Decorator\EmptyDescriptionDecorator();
    }
}
