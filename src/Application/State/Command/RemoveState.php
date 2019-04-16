<?php

namespace RGA\Application\State\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class RemoveState implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setIdentifier($uuid);
    }
}
