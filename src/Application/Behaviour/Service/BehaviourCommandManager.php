<?php

namespace RGA\Application\Behaviour\Service;

use RGA\Application\Behaviour\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class BehaviourCommandManager extends AbstractCommandManager
{
    /**
     * @param BehaviourDataProvider $provider
     */
    public function create(BehaviourDataProvider $provider): void
    {
        $command = new Command\CreateBehaviour(
            $provider->uuid(),
            $provider->type(),
            $provider->names(),
            $provider->activation()
        );
        
        $this->handle($command);
    }
    
    /**
     * @param BehaviourDataProvider $provider
     */
    public function change(BehaviourDataProvider $provider): void
    {
        $command = new Command\ChangeBehaviour(
            $provider->uuid(),
            $provider->names(),
            $provider->activation()
        );
        
        $this->handle($command);
    }
}
