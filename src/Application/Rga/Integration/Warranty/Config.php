<?php

namespace RGA\Application\Rga\Integration\Warranty;

use RGA\Infrastructure\Source\Warranty;

class Config implements Warranty\ConfigInterface
{
    /** @var Warranty\ConfigStorage\ConfigStorageInterface */
    private $storage;
    
    /**
     * @param Warranty\ConfigStorage\ConfigStorageInterface $storage
     */
    public function __construct(Warranty\ConfigStorage\ConfigStorageInterface $storage)
    {
        $this->storage = $storage;
    }
    
    /**
     * @return int
     */
    public function getDaysToReturns(): int
    {
        return $this->storage->getDaysToReturns();
    }

    /**
     * @return int
     */
    public function getMonthsToComplaint(): int
    {
        return $this->storage->getMonthsToComplaint();
    }
    
    /**
     * @return int
     */
    public function getWarrantyInMonths(): int
    {
        return $this->storage->getWarrantyInMonths();
    }
}
