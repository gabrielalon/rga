<?php

namespace RGA\Domain\Model\State\State;

use RGA\Infrastructure\Model\Translate\Locales;

final class EmailSubjects extends Locales
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
     * @return EmailSubjects
     */
    public static function fromArray(array $data): EmailSubjects
    {
        return new EmailSubjects($data);
    }
}
