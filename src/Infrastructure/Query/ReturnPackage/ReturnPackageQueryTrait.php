<?php

namespace RGA\Infrastructure\Query\ReturnPackage;

use RGA\Application\ReturnPackage\Query;
use RGA\Domain\Model\ReturnPackage\ReturnPackage as VO;

trait ReturnPackageQueryTrait
{
    /**
     * @param Query\ReadModel\ReturnPackageCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\ReturnPackageCollection $collection, \stdClass $row): void
    {
        if (true === $collection->has($row->uuid)) {
            $view = $collection->get($row->uuid)
                ->addTransportName($row->transport_locale, $row->transport_name);
        } else {
            $view = Query\ReadModel\ReturnPackage::fromId($row->id)
                ->setRgaUuid(VO\RgaUuid::fromString((string)$row->rga_id))
                ->setTransportUuid(VO\TransportUuid::fromString((string)$row->rga_transport_method_id))
                ->setNettPrice(VO\NettPrice::fromFloat((float)$row->nett_price))
                ->setVatRate(VO\VatRate::fromInteger((int)(100 * $row->vat_rate)))
                ->setCurrency(VO\Currency::fromString((string)$row->currency))
                ->setPackageSent(VO\PackageSent::fromBoolean((bool)$row->package_sent))
                ->setPackageNo(VO\PackageNo::fromString((string)$row->package_no))
                ->setPackageSentAt(VO\PackageSentAt::fromString((string)($row->package_sent_at ?? date('Y-m-d H:i:s'))));
        }
        
        $collection->add($view);
    }
}
