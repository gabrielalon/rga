<?php

namespace RGA\Application\Additional\Service;

use RGA\Application\Additional\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class AdditionalQueryManager extends AbstractQueryManager
{
    /**
     * @param string $uuid
     * @return Query\ReadModel\AdditionalCollection
     */
    public function findAllByRgaUuid(string $uuid): Query\ReadModel\AdditionalCollection
    {
        $query = new Query\V1\FindAllByRgaUuid($uuid);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\AdditionalCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
}
