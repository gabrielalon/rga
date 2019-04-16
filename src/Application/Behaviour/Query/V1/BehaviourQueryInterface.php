<?php

namespace RGA\Application\Behaviour\Query\V1;

interface BehaviourQueryInterface
{
    /**
     * @param FindOneByUuid $query
     */
    public function findOneByUuid(FindOneByUuid $query): void;
    
    /**
     * @param FindOneByType $query
     */
    public function findOneByType(FindOneByType $query): void;
    
    /**
     * @param FindAll $query
     */
    public function findAll(FindAll $query): void;
    
    /**
     * @param FindAllActive $query
     */
    public function findAllActive(FindAllActive $query): void;
}
