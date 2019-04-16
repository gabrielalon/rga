<?php

namespace RGA\Infrastructure\Source\Service;

use RGA\Domain\Model\Rga\Rga\Applicant\Applicant;
use RGA\Domain\Model\Source\RgaObjectBuilder;
use RGA\Domain\Model\Source\RgaObjectItemBuilder;
use RGA\Domain\Model\Source\RgaObjectItemCollector;
use RGA\Infrastructure\Source\RgaObject;

class StandardService implements ServiceInterface
{
    /**
     * @return string
     */
    public function sourceType(): string
    {
        return 'unknown';
    }
    
    /**
     * @param string $id
     * @return RgaObject\RgaObjectInterface
     * @throws \InvalidArgumentException
     */
    public function buildObject($id): RgaObject\RgaObjectInterface
    {
        $builder = new RgaObjectBuilder(
            $id,
            $this->sourceType(),
            new Applicant(0, 'guest'),
            true,
            time(),
            true
        );
        
        $items = new RgaObjectItemCollector();
        $items->add($this->buildObjectItem(0));
        
        $builder->setItems($items);
        
        return $builder->build();
    }
    
    /**
     * @param string $itemId
     * @return RgaObject\RgaObjectItemInterface
     * @throws \InvalidArgumentException
     */
    public function buildObjectItem($itemId): RgaObject\RgaObjectItemInterface
    {
        $rmaObjectItemBuilder = new RgaObjectItemBuilder(
            $itemId,
            0,
            ''
        );
        
        return $rmaObjectItemBuilder->build();
    }
}
