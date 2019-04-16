<?php

namespace RGA\Domain\Model\Rga\Rga\Reference;

class References
{
    /** @var string */
    private $stateUuid;
    
    /** @var string */
    private $behaviourUuid;
    
    /** @var string */
    private $behaviourType;
    
    /** @var string */
    private $transportUuid;
    
    /**
     * @param string $stateUuid
     * @param string $behaviourUuid
     * @param string $behaviourType
     * @param string $transportUuid
     */
    public function __construct(string $stateUuid, string $behaviourUuid, string $behaviourType, string $transportUuid)
    {
        $this->stateUuid = $stateUuid;
        $this->behaviourUuid = $behaviourUuid;
        $this->behaviourType = $behaviourType;
        $this->transportUuid = $transportUuid;
    }
    
    /**
     * @return string
     */
    public function getStateUuid(): string
    {
        return $this->stateUuid;
    }
    
    /**
     * @return string
     */
    public function getBehaviourUuid(): string
    {
        return $this->behaviourUuid;
    }
    
    /**
     * @return string
     */
    public function getBehaviourType(): string
    {
        return $this->behaviourType;
    }
    
    /**
     * @return string
     */
    public function getTransportUuid(): string
    {
        return $this->transportUuid;
    }
}
