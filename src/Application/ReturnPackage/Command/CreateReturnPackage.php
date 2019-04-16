<?php

namespace RGA\Application\ReturnPackage\Command;

use Ayeo\Price\Price;
use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateReturnPackage implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $rgaUuid;
    
    /** @var string */
    private $transportUuid;
    
    /** @var Price */
    private $price;
    
    /**
     * @param int $id
     * @param string $rgaUuid
     * @param string $transportUuid
     * @param Price $price
     */
    public function __construct(int $id, string $rgaUuid, string $transportUuid, Price $price)
    {
        $this->setIdentifier($id);
        $this->rgaUuid = $rgaUuid;
        $this->transportUuid = $transportUuid;
        $this->price = $price;
    }
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->getIdentifier();
    }
    
    /**
     * @return string
     */
    public function getRgaUuid(): string
    {
        return $this->rgaUuid;
    }
    
    /**
     * @return string
     */
    public function getTransportUuid(): string
    {
        return $this->transportUuid;
    }
    
    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }
}
