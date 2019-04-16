<?php

namespace RGA\Application\Additional\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Additional\Command;
use RGA\Infrastructure\Persist\Additional\AdditionalRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory extends CommandHandling\AbstractCommandBusFactory
{
    /**
     * @param CommandHandling\CommandBus $commandBus
     * @param ContainerInterface $container
     */
    public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
    {
        /** @var AdditionalRepository $additionalRepository */
        $additionalRepository = $container->get(AdditionalRepository::class);
        
        $this->commandRouter
            ->route(Command\CreateAdditional::class)
            ->to(new Command\CreateAdditionalHandler($additionalRepository));
        
        $this->attachRoutesToCommandBus($commandBus);
    }
}
