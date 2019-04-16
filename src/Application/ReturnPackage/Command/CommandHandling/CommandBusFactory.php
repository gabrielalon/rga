<?php

namespace RGA\Application\ReturnPackage\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\ReturnPackage\Command;
use RGA\Infrastructure\Persist\ReturnPackage\ReturnPackageRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory extends CommandHandling\AbstractCommandBusFactory
{
    /**
     * @param CommandHandling\CommandBus $commandBus
     * @param ContainerInterface $container
     */
    public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
    {
        /** @var ReturnPackageRepository $returnPackageRepository */
        $returnPackageRepository = $container->get(ReturnPackageRepository::class);
        
        $this->commandRouter
            ->route(Command\CreateReturnPackage::class)
            ->to(new Command\CreateReturnPackageHandler($returnPackageRepository));
        
        $this->commandRouter
            ->route(Command\SetReturnPackage::class)
            ->to(new Command\SetReturnPackageHandler($returnPackageRepository));
        
        $this->attachRoutesToCommandBus($commandBus);
    }
}
