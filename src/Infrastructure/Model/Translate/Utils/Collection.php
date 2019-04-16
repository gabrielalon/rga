<?php

namespace RGA\Infrastructure\Model\Translate\Utils;

use RGA\Infrastructure\Model\Translate\Exception;
use RGA\Infrastructure\Model\Translate\Translate;

class Collection extends \ArrayIterator
{
    /**
     * @param Translate\Locale $locale
     * @param Translate\Value $value
     */
    public function add(Translate\Locale $locale, Translate\Value $value)
    {
        $this->offsetSet($locale->toString(), $value);
    }
    
    /**
     * @param string $locale
     * @return Translate\Value
     */
    public function get(string $locale)
    {
        if (false === $this->offsetExists($locale)) {
            throw new Exception\NotFoundLocaleStringException('Not Found Locale string: ' . $locale);
        }
        
        /** @var Translate\Value $value */
        $value = $this->offsetGet($locale);
        
        return $value;
    }
    
    /**
     * @param Collection $other
     * @return bool
     */
    public function equals($other): bool
    {
        if (false === $other instanceof Collection) {
            return false;
        }
        
        /**
         * @var string $locale
         * @var Translate\Value $value
         */
        foreach ($this->getArrayCopy() as $locale => $value) {
            try {
                $otherValue = $other->get($locale);
            } catch (Exception\NotFoundLocaleStringException $e) {
                return false;
            }
            
            if (false === $value->equals($otherValue)) {
                return false;
            }
        }
        
        return true;
    }
}
