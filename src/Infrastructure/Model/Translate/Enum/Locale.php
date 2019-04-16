<?php

namespace RGA\Infrastructure\Model\Translate\Enum;

use RGA\Application\Enum;

class Locale extends Enum\Enum
{
    public const __default = Locale::PL;
    
    public const PL = 'pl';
    public const EN = 'en';
    public const RU = 'ru';
    public const DE = 'de';
    
    /**
     * @param string $type
     * @return bool
     */
    public static function isValid($type): bool
    {
        try {
            new Locale($type);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
