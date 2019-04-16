<?php

namespace RGA\Application\ReturnPackage\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class SetReturnPackage implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $packageNo;
    
    /** @var string */
    private $sentAt;
    
    /**
     * @param integer $id
     * @param string $packageNo
     * @param string $sentAt
     */
    public function __construct(int $id, string $packageNo, string $sentAt)
    {
        $this->setIdentifier($id);
        $this->packageNo = $packageNo;
        $this->sentAt = $sentAt;
    }
    
    public function getId()
    {
        return $this->getIdentifier();
    }
    
    /**
     * @return string
     */
    public function getPackageNo(): string
    {
        return $this->packageNo;
    }
    
    /**
     * @return string
     */
    public function getSentAt(): string
    {
        return $this->sentAt;
    }
}
