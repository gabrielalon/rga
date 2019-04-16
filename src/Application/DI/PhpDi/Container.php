<?php

namespace RGA\Application\DI\PhpDi;

use RGA\Application\Rga\Integration;
use RGA\Infrastructure\Source\Warranty;

class Container
{
    /**
     * @return \DI\Container
     * @throws \Exception
     */
    public function initialize(): \DI\Container
    {
        $builder = new \DI\ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->addDefinitions((new ContainerBuilder())->build());
        $builder->addDefinitions([
            Warranty\ConfigInterface::class => new Integration\Warranty\Config(new Warranty\ConfigStorage\VendorConfigurationFile()),
            Integration\Warranty\Calculator::class => new Integration\Warranty\Calculator(new Integration\Warranty\Config(new Warranty\ConfigStorage\VendorConfigurationFile()))
        ]);
        
        return $builder->build();
    }
}
