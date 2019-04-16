<?php

namespace RGA\Application\Transport\Query\V1;

interface TransportQueryInterface
{
    /**
     * @param FindOneByUuid $query
     */
    public function findOneByUuid(FindOneByUuid $query): void;
    
    /**
     * @param FindAll $query
     */
    public function findAll(FindAll $query): void;
    
    /**
     * @param FindAllActiveForDomain $query
     */
    public function findAllActiveForDomain(FindAllActiveForDomain $query): void;
    
    /**
     * @param FindAllActive $query
     */
    public function findAllActive(FindAllActive $query): void;
}
