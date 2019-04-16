<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

use RGA\Application\Attachment\Service\AttachmentCommandManager;
use RGA\Application\Behaviour\Service\BehaviourCommandManager;
use RGA\Application\Dictionary\Service\DictionaryCommandManager;
use RGA\Application\ReturnPackage\Service\ReturnPackageCommandManager;
use RGA\Application\Rga\Service\RgaCommandManager;
use RGA\Application\State\Service\StateCommandManager;
use RGA\Application\Transport\Service\TransportCommandManager;

class CommandManager
{
    /** @var CommandManagerRegistry */
    private $registry;
    
    /**
     * @param CommandManagerRegistry $registry
     */
    public function __construct(CommandManagerRegistry $registry)
    {
        $this->registry = $registry;
    }
    
    /**
     * @return AttachmentCommandManager
     */
    public function attachment(): AttachmentCommandManager
    {
        return $this->registry->get(AttachmentCommandManager::class);
    }
    
    /**
     * @return BehaviourCommandManager
     */
    public function behaviour(): BehaviourCommandManager
    {
        return $this->registry->get(BehaviourCommandManager::class);
    }
    
    /**
     * @return DictionaryCommandManager
     */
    public function dictionary(): DictionaryCommandManager
    {
        return $this->registry->get(DictionaryCommandManager::class);
    }
    
    /**
     * @return ReturnPackageCommandManager
     */
    public function returnPackage(): ReturnPackageCommandManager
    {
        return $this->registry->get(ReturnPackageCommandManager::class);
    }
    
    /**
     * @return RgaCommandManager
     */
    public function rga(): RgaCommandManager
    {
        return $this->registry->get(RgaCommandManager::class);
    }
    
    /**
     * @return StateCommandManager
     */
    public function state(): StateCommandManager
    {
        return $this->registry->get(StateCommandManager::class);
    }
    
    /**
     * @return TransportCommandManager
     */
    public function transport(): TransportCommandManager
    {
        return $this->registry->get(TransportCommandManager::class);
    }
}
