<?php

namespace RGA\Application\Additional\Query\Decorator;

use RGA\Application\Additional\Query\ReadModel\Additional;

interface DescriptionDecoratorInterface
{
    /**
     * @return string
     */
    public function getType(): string;
    
    /**
     * @param Additional $additional
     * @param string $locale
     * @return string
     */
    public function extract(Additional $additional, string $locale): string;
}
