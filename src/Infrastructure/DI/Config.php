<?php

namespace RGA\Infrastructure\DI;

class Config
{
    /**
     * @var array
     */
    private $definitions = [];
    
    public function __construct()
    {
        $file = __DIR__ . '/../../../config/phpdi.php';
        if (true === file_exists($file)) {
            $definitions = include($file);
            if (is_array($definitions)) {
                $this->definitions = $definitions;
                
                return;
            }
        }
        
        throw new \RuntimeException("Container definition not configured");
    }
    
    /**
     * @return array
     */
    public function getDefinitions(): array
    {
        return $this->definitions;
    }
}
