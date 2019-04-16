<?php

namespace RGA\Application\ReturnPackage\Query\V1;

interface ReturnPackageQueryInterface
{
    /**
     * @param FindOneById $query
     */
    public function findOneById(FindOneById $query): void;
    
    /**
     * @param FindAllByRgaUuid $query
     */
    public function findAllByRgaUuid(FindAllByRgaUuid $query): void;
}
