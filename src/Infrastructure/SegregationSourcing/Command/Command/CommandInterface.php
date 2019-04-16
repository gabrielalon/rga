<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\Command;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

interface CommandInterface extends MessageInterface
{
    /**
     * @return string|integer
     */
    public function getIdentifier();
    
    /**
     * @param string|integer $identifier
     */
    public function setIdentifier($identifier);
}
