<?php

namespace RGA\Application\Dictionary\Command;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeDictionaryHandler implements CommandHandlerInterface
{
    /** @var DictionaryRepository */
    private $repository;
    
    /**
     * @param DictionaryRepository $repository
     */
    public function __construct(DictionaryRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param MessageInterface|CreateDictionary $message
     */
    public function run(MessageInterface $message): void
    {
        $dictionary = $this->repository->find($message->getIdentifier());
        
        $dictionary->changeExistingDictionary(
            Dictionary\Entries::fromArray($message->getEntries()),
            Dictionary\BehavioursUuid::fromArray($message->getBehaviours())
        );
        
        $this->repository->save($dictionary);
    }
}
