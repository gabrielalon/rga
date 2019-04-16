<?php

namespace RGA\Application\Dictionary\Enum;

use RGA\Application\Enum;

class Type extends Enum\Enum
{
    public const __default = Type::REASON;
    
    public const CONTACT_PREFERENCE = 'contact_preference';
    public const EXPECTATION = 'expectation';
    public const REASON = 'reason';
}
