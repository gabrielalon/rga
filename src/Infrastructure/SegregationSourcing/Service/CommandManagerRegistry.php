<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

class CommandManagerRegistry
{
    /** @var AbstractCommandManager[] */
    private $registry = [];
    
    /**
     * @param AbstractCommandManager $commandManager
     */
    public function register(AbstractCommandManager $commandManager): void
    {
        $this->registry[\get_class($commandManager)] = $commandManager;
    }
    
    /**
     * @param string $class
     * @return AbstractCommandManager
     */
    public function get(string $class): AbstractCommandManager
    {
        return $this->registry[$class];
    }
}
