<?php

namespace RGA\Infrastructure\SegregationSourcing\Message\Messaging;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

interface MessageHandlerInterface
{
    /**
     * @param MessageInterface $message
     */
    public function run(MessageInterface $message);
}
