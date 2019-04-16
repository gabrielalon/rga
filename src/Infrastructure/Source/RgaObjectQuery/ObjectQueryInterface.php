<?php

namespace RGA\Infrastructure\Source\RgaObjectQuery;

use RGA\Infrastructure\Source\RgaObject;

interface ObjectQueryInterface
{
    /**
     * @param string $type
     * @param integer $id
     * @return RgaObject\RgaObjectInterface
     * @throws \RuntimeException
     */
    public function getByObjectInfo($type, $id): RgaObject\RgaObjectInterface;
    
    /**
     * @param string $type
     * @param integer $itemId
     * @return RgaObject\RgaObjectItemInterface
     * @throws \RuntimeException
     */
    public function getByObjectItemInfo($type, $itemId): RgaObject\RgaObjectItemInterface;
}
