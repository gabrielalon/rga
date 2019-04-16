<?php

namespace RGA\Application\Dictionary\Query\V1;

class FindAllByTypeAndBehaviourUuid extends FindAllByType
{
    /** @var string */
    private $uuid;
    
    /**
     * @param string $type
     * @param string $uuid
     */
    public function __construct(string $type, string $uuid)
    {
        $this->uuid = $uuid;
        parent::__construct($type);
    }
    
    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
