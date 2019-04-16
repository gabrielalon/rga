<?php

namespace RGA\Application\SegregationSourcing\Query\Decorator;

use RGA\Infrastructure\SegregationSourcing\Aggregate;

interface DescriptionDecoratorInterface
{
    /**
     * @return string
     */
    public function name(): string;
    
    /**
     * @param Aggregate\EventBridge\AggregateChanged $event
     * @param string $locale
     * @return string
     */
    public function extract(Aggregate\EventBridge\AggregateChanged $event, string $locale): string;
}
