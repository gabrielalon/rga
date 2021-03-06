<?php

namespace RGA\Domain\Model\State\State;

use RGA\Infrastructure\Model\Translate\Locales;

final class EmailBodies extends Locales
{
    /**
     * @param array $data
     */
    protected function __construct(array $data)
    {
        $this->skipValidation();
        parent::__construct($data);
    }
    
    /**
     * @param array $data
     * @return EmailBodies
     */
    public static function fromArray(array $data): EmailBodies
    {
        return new EmailBodies($data);
    }
}
