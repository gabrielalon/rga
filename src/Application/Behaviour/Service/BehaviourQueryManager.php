<?php

namespace RGA\Application\Behaviour\Service;

use RGA\Application\Behaviour\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class BehaviourQueryManager extends AbstractQueryManager
{
    /**
     * @return Query\ReadModel\BehaviourCollection
     */
    public function findAll(): Query\ReadModel\BehaviourCollection
    {
        $query = new Query\V1\FindAll();
        
        $this->handle($query);
        
        /** @var Query\ReadModel\BehaviourCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @return Query\ReadModel\BehaviourCollection
     */
    public function findAllActive(): Query\ReadModel\BehaviourCollection
    {
        $query = new Query\V1\FindAllActive();
        
        $this->handle($query);
        
        /** @var Query\ReadModel\BehaviourCollection $collection */
        $collection = $query->getViewCollection();
        
        return $collection;
    }
    
    /**
     * @param string $type
     * @return Query\ReadModel\Behaviour
     */
    public function findOneByType(string $type): Query\ReadModel\Behaviour
    {
        $query = new Query\V1\FindOneByType($type);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\Behaviour $view */
        $view = $query->getView();
        
        return $view;
    }
    
    /**
     * @param string $uuid
     * @return Query\ReadModel\Behaviour
     */
    public function findOneByUuid(string $uuid): Query\ReadModel\Behaviour
    {
        $query = new Query\V1\FindOneByUuid($uuid);
        
        $this->handle($query);
        
        /** @var Query\ReadModel\Behaviour $view */
        $view = $query->getView();
        
        return $view;
    }
}
