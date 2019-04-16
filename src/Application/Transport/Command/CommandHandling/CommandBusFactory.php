<?php

namespace RGA\Application\Transport\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Transport\Command;
use RGA\Infrastructure\Persist\Transport\TransportRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory extends CommandHandling\AbstractCommandBusFactory
{
    /**
     * @param CommandHandling\CommandBus $commandBus
     * @param ContainerInterface $container
     */
    public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
    {
        /** @var TransportRepository $transportRepository */
        $transportRepository = $container->get(TransportRepository::class);
        
        $this->commandRouter
            ->route(Command\CreateTransport::class)
            ->to(new Command\CreateTransportHandler($transportRepository));
        
        $this->commandRouter
            ->route(Command\ChangeTransport::class)
            ->to(new Command\ChangeTransportHandler($transportRepository));
        
        $this->commandRouter
            ->route(Command\RemoveTransport::class)
            ->to(new Command\RemoveTransportHandler($transportRepository));
        
        $this->attachRoutesToCommandBus($commandBus);
    }
}
