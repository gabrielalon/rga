<?php

namespace RGA\Application\SegregationSourcing\Query\Decorator\Decorator;

use RGA\Application\SegregationSourcing\Query\Decorator\DescriptionDecoratorInterface;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class DefaultDescriptionDecorator implements DescriptionDecoratorInterface
{
    /**
     * @return string
     */
    public function name(): string
    {
        return __CLASS__;
    }
    
    /**
     * @param Aggregate\EventBridge\AggregateChanged $event
     * @param string $locale
     * @return string
     */
    public function extract(Aggregate\EventBridge\AggregateChanged $event, string $locale): string
    {
        return '';
    }
}
