<?php

namespace RGA\Application\ReturnPackage\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class ReturnPackageCollection extends \ArrayIterator implements ViewableCollection
{
    /**
     * @param ReturnPackage $returnPackage
     */
    public function add(ReturnPackage $returnPackage): void
    {
        $this->offsetSet($returnPackage->identifier(), $returnPackage);
    }
    
    /**
     * @param string $uuid
     * @return ReturnPackage
     */
    public function get(string $uuid): ReturnPackage
    {
        return $this->offsetGet($uuid);
    }
    
    /**
     * @param string $uuid
     * @return bool
     */
    public function has(string $uuid): bool
    {
        return $this->offsetExists($uuid);
    }
    
    /**
     * @return ReturnPackage[]
     */
    public function all(): array
    {
        return $this->getArrayCopy();
    }
}
