<?php

namespace RGA\Domain\Model\Rga\Rga\Applicant;

class Applicant
{
    /** @var integer */
    private $id;
    
    /** @var string */
    private $type;
    
    /**
     * @param int $id
     * @param string $type
     */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }
    
    /**
     * @return string
     */
    public function getType(): string
    {
        return (string)$this->type;
    }
}
