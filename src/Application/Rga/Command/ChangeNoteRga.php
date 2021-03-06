<?php

namespace RGA\Application\Rga\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeNoteRga implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $note;
    
    /**
     * @param string $uuid
     * @param string $note
     */
    public function __construct(string $uuid, string $note)
    {
        $this->setIdentifier($uuid);
        $this->note = $note;
    }
    
    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}
