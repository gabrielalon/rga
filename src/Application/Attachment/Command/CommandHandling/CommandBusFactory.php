<?php

namespace RGA\Application\Attachment\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Attachment\Command;
use RGA\Infrastructure\Persist\Attachment\AttachmentRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory extends CommandHandling\AbstractCommandBusFactory
{
    /**
     * @param CommandHandling\CommandBus $commandBus
     * @param ContainerInterface $container
     */
    public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
    {
        /** @var AttachmentRepository $attachmentRepository */
        $attachmentRepository = $container->get(AttachmentRepository::class);
        
        $this->commandRouter
            ->route(Command\CreateAttachment::class)
            ->to(new Command\CreateAttachmentHandler($attachmentRepository));
        
        $this->commandRouter
            ->route(Command\RemoveAttachment::class)
            ->to(new Command\RemoveAttachmentHandler($attachmentRepository));
        
        $this->attachRoutesToCommandBus($commandBus);
    }
}
