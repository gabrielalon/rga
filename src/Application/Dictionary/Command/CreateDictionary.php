<?php

namespace RGA\Application\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateDictionary implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $type;
    
    /** @var array */
    private $entries;
    
    /** @var array */
    private $behaviours;
    
    /**
     * @param string $uuid
     * @param string $type
     * @param array $entries
     * @param array $behaviours
     */
    public function __construct(string $uuid, string $type, array $entries, array $behaviours)
    {
        $this->setIdentifier($uuid);
        $this->type = $type;
        $this->entries = $entries;
        $this->behaviours = $behaviours;
    }
    
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }
    
    /**
     * @return array
     */
    public function getBehaviours(): array
    {
        return $this->behaviours;
    }
}
