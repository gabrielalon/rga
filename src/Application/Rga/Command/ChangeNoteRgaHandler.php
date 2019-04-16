<?php

namespace RGA\Application\Rga\Command;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Infrastructure\Persist\Rga\RgaRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeNoteRgaHandler implements CommandHandlerInterface
{
    /** @var RgaRepository */
    private $repository;
    
    /**
     * @param RgaRepository $repository
     */
    public function __construct(RgaRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|ChangeNoteRga $message
     */
    public function run(MessageInterface $message): void
    {
        $rga = $this->repository->find($message->getIdentifier());
        
        $rga->noteRgaChanged(ValueObject\AdminNotes::fromString($message->getNote()));
        
        $this->repository->save($rga);
    }
}
