<?php

namespace RGA\Application\Transport\Command;

use RGA\Infrastructure\Persist\Transport\TransportRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class RemoveTransportHandler implements CommandHandlerInterface
{
    /** @var TransportRepository */
    private $repository;
    
    /**
     * @param TransportRepository $repository
     */
    public function __construct(TransportRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|RemoveTransport $message
     */
    public function run(MessageInterface $message): void
    {
        $transport = $this->repository->find($message->getIdentifier());
        
        $transport->removeExistingTransport();
        
        $this->repository->save($transport);
    }
}
