<?php

namespace RGA\Infrastructure\Query\Additional;

use RGA\Application\Additional\Query;
use RGA\Domain\Model\Additional\Additional as VO;

trait AdditionalQueryTrait
{
    /**
     * @param Query\ReadModel\AdditionalCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\AdditionalCollection $collection, \stdClass $row): void
    {
        $collection->add(
            Query\ReadModel\Additional::fromId($row->uuid)
            ->setRgaUuid(VO\RgaUuid::fromString((string)$row->rga_uuid))
            ->setServiceType(VO\ServiceType::fromString((string)$row->service_type))
            ->setServiceData(VO\ServiceData::fromArray((array)$row->service_data))
        );
    }
}
