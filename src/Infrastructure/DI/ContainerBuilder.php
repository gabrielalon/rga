<?php

namespace RGA\Infrastructure\DI;

abstract class ContainerBuilder
{
    
    /**
     * @return array
     */
    public function build()
    {
        $definitions = [];
        $config = new Config();
        foreach ($config->getDefinitions() as $name => $value) {
            $definition = $this->buildDefinition($value);
            $definitions[$name] = $definition;
        }
        
        return $definitions;
    }
    
    /**
     * Method should build di definition (object, callable or DI specific class
     *
     * @param  mixed $value
     * @return mixed
     */
    abstract protected function buildDefinition($value);
}
