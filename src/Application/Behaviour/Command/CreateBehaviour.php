<?php

namespace RGA\Application\Behaviour\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateBehaviour implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var string */
    private $type;
    
    /** @var array */
    private $names;
    
    /** @var boolean */
    private $isActive;
    
    /**
     * @param string $uuid
     * @param string $type
     * @param array $names
     * @param bool $isActive
     */
    public function __construct(string $uuid, string $type, array $names, bool $isActive)
    {
        $this->setIdentifier($uuid);
        $this->type = $type;
        $this->names = $names;
        $this->isActive = $isActive;
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
    public function getNames(): array
    {
        return $this->names;
    }
    
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }
}
