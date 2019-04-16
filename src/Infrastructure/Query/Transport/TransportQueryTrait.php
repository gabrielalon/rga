<?php

namespace RGA\Infrastructure\Query\Transport;

use RGA\Application\Transport\Query;
use RGA\Domain\Model\Transport\Transport as VO;

trait TransportQueryTrait
{
    /**
     * @param Query\ReadModel\TransportCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\TransportCollection $collection, \stdClass $row): void
    {
        if (true === $collection->has($row->uuid)) {
            $view = $collection->get($row->uuid)
                ->addName($row->locale, $row->name);
        } else {
            $view = Query\ReadModel\Transport::fromUuid($row->uuid)
                ->setActive(VO\Active::fromBoolean((bool)$row->is_active))
                ->setShipmentId(VO\ShipmentId::fromInteger((int)$row->shipment_method_id))
                ->addDomains(explode('|', $row->domains))
                ->addName($row->locale, $row->name);
        }
        
        $collection->add($view);
    }
}
