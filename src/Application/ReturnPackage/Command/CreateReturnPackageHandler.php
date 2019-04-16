<?php

namespace RGA\Application\ReturnPackage\Command;

use RGA\Domain\Model\ReturnPackage\ReturnPackage;
use RGA\Infrastructure\Persist\ReturnPackage\ReturnPackageRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class CreateReturnPackageHandler implements CommandHandlerInterface
{
    /** @var ReturnPackageRepository */
    private $repository;
    
    /**
     * @param ReturnPackageRepository $repository
     */
    public function __construct(ReturnPackageRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|CreateReturnPackage $message
     */
    public function run(MessageInterface $message): void
    {
        $returnPackage = ReturnPackage::createNewReturnPackage(
            ReturnPackage\Id::fromInteger($message->getId()),
            ReturnPackage\RgaUuid::fromString($message->getRgaUuid()),
            ReturnPackage\TransportUuid::fromString($message->getTransportUuid()),
            ReturnPackage\NettPrice::fromFloat($message->getPrice()->getNett()),
            ReturnPackage\VatRate::fromInteger($message->getPrice()->getTaxRate()),
            ReturnPackage\Currency::fromString($message->getPrice()->getCurrencySymbol())
        );
        
        $this->repository->save($returnPackage);
    }
}
