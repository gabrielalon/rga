<?php

namespace RGA\Application\Source\Service;

use RGA\Application\Source\Query;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class RgaObjectQueryManager extends AbstractQueryManager
{
    /**
     * @param int|string $id
     * @param string $type
     * @param int|string $givenId
     * @return RgaObject
     */
    public function getOne($id, $type, $givenId): RgaObject
    {
        $query = new Query\GetOne();
        $query->setId($id);
        $query->setType($type);
        $query->setGivenId($givenId);
        
        $this->handle($query);
        
        return $query->getObject();
    }
}
