<?php

namespace RGA\Application\ReturnPackage\Service;

use RGA\Application\ReturnPackage\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class ReturnPackageCommandManager extends AbstractCommandManager
{
    /**
     * @param ReturnPackageDataProvider $provider
     */
    public function create(ReturnPackageDataProvider $provider): void
    {
        $command = new Command\CreateReturnPackage(
            $provider->id(),
            $provider->rgaUuid(),
            $provider->transportUuid(),
            $provider->price()
        );
        
        $this->handle($command);
    }
    
    /**
     * @param ReturnPackageDataProvider $provider
     */
    public function setPackage(ReturnPackageDataProvider $provider): void
    {
        $command = new Command\SetReturnPackage(
            $provider->id(),
            $provider->packageNo(),
            $provider->setAt()->format('Y-m-d H:i:s')
        );
        
        $this->handle($command);
    }
}
