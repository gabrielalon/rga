<?php

namespace RGA\Application\Transport\Service;

use RGA\Application\Transport\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class TransportQueryManager extends AbstractQueryManager
{
    /**
     * @return Query\ReadModel\TransportCollection
     */
    public function findAll(): Query\ReadModel\TransportCollection
    {
        $query = new Query\V1\FindAll();
        
        $this->handle($query);
        
        /** @var Query\ReadModel\TransportCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @param string $domain
     * @return Query\ReadModel\TransportCollection
     */
    public function findAllActiveForDomain(string $domain): Query\ReadModel\TransportCollection
    {
        $query = new Query\V1\FindAllActiveForDomain($domain);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\TransportCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @return Query\ReadModel\TransportCollection
     */
    public function findAllActive(): Query\ReadModel\TransportCollection
    {
        $query = new Query\V1\FindAllActive();
        
        $this->handle($query);
        
        /** @var Query\ReadModel\TransportCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @param string $uuid
     * @return Query\ReadModel\Transport
     */
    public function findOneByUuid(string $uuid): Query\ReadModel\Transport
    {
        $query = new Query\V1\FindOneByUuid($uuid);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\Transport $transport */
        $transport = $query->getView();
        
        return $transport;
    }
}
