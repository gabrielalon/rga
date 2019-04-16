<?php

namespace RGA\Application\Attachment\Command;

use RGA\Infrastructure\Persist\Attachment\AttachmentRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class RemoveAttachmentHandler implements CommandHandlerInterface
{
    /** @var AttachmentRepository */
    private $repository;
    
    /**
     * @param AttachmentRepository $repository
     */
    public function __construct(AttachmentRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|RemoveAttachment $message
     */
    public function run(MessageInterface $message): void
    {
        $attachment = $this->repository->find($message->getIdentifier());
        
        $attachment->removeExistingAttachment();
        
        $this->repository->save($attachment);
    }
}
