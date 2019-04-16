<?php

namespace RGA\Application\Attachment\Command;

use RGA\Domain\Model\Attachment\Attachment;
use RGA\Infrastructure\Persist\Attachment\AttachmentRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class CreateAttachmentHandler implements CommandHandlerInterface
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
     * @param MessageInterface|CreateAttachment $message
     */
    public function run(MessageInterface $message): void
    {
        $attachment = Attachment::createNewAttachment(
            Attachment\Uuid::fromString($message->getIdentifier()),
            Attachment\RgaUuid::fromString($message->getRgaUuid()),
            Attachment\FileType::fromString($message->getFileType()),
            Attachment\FileName::fromString($message->getFileName()),
            Attachment\OriginalFileName::fromString($message->getOriginalFileName())
        );
        
        $this->repository->save($attachment);
    }
}
