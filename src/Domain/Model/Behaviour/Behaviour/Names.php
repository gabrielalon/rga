<?php

namespace RGA\Domain\Model\Behaviour\Behaviour;

use RGA\Infrastructure\Model\Translate\Locales;

final class Names extends Locales
{
    /**
     * @param array $data
     * @return Names
     */
    public static function fromArray(array $data): Names
    {
        return new Names($data);
    }
}
