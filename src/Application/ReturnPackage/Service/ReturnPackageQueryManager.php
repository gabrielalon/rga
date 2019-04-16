<?php

namespace RGA\Application\ReturnPackage\Service;

use RGA\Application\ReturnPackage\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class ReturnPackageQueryManager extends AbstractQueryManager
{
    /**
     * @param string $uuid
     * @return Query\ReadModel\ReturnPackageCollection
     */
    public function findAllByRgaUuid(string $uuid): Query\ReadModel\ReturnPackageCollection
    {
        $query = new Query\V1\FindAllByRgaUuid($uuid);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\ReturnPackageCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @param int $id
     * @return Query\ReadModel\ReturnPackage
     */
    public function findOneById(int $id): Query\ReadModel\ReturnPackage
    {
        $query = new Query\V1\FindOneById($id);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\ReturnPackage $view */
        $view = $query->getView();
        
        return $view;
    }
}
