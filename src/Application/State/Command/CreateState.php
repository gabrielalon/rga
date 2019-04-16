<?php

namespace RGA\Application\State\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateState implements Command\CommandInterface
{
    use Command\CommandTrait;
    
    /** @var boolean */
    private $isEditable;
    
    /** @var boolean */
    private $isDeletable;
    
    /** @var boolean */
    private $isRejectable;
    
    /** @var boolean */
    private $isFinishable;
    
    /** @var boolean */
    private $isCloseable;
    
    /** @var boolean */
    private $isSendingEmail;
    
    /** @var string */
    private $colorCode;
    
    /** @var array */
    private $names;
    
    /** @var array */
    private $emailSubjects;
    
    /** @var array */
    private $emailBodies;
    
    /**
     * @param string $uuid
     * @param bool $isEditable
     * @param bool $isDeletable
     * @param bool $isRejectable
     * @param bool $isFinishable
     * @param bool $isCloseable
     * @param bool $isSendingEmail
     * @param string $colorCode
     * @param array $names
     * @param array $emailSubjects
     * @param array $emailBodies
     */
    public function __construct(
        string $uuid,
        bool $isEditable = true,
        bool $isDeletable = true,
        bool $isRejectable = true,
        bool $isFinishable = true,
        bool $isCloseable = true,
        bool $isSendingEmail = true,
        string $colorCode = '#000000',
        array $names = [],
        array $emailSubjects = [],
        array $emailBodies = []
    ) {
        $this->setIdentifier($uuid);
        $this->isEditable = $isEditable;
        $this->isDeletable = $isDeletable;
        $this->isRejectable = $isRejectable;
        $this->isFinishable = $isFinishable;
        $this->isCloseable = $isCloseable;
        $this->isSendingEmail = $isSendingEmail;
        $this->colorCode = $colorCode;
        $this->names = $names;
        $this->emailSubjects = $emailSubjects;
        $this->emailBodies = $emailBodies;
    }
    
    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->isEditable;
    }
    
    /**
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->isDeletable;
    }
    
    /**
     * @return bool
     */
    public function isRejectable(): bool
    {
        return $this->isRejectable;
    }
    
    /**
     * @return bool
     */
    public function isFinishable(): bool
    {
        return $this->isFinishable;
    }
    
    /**
     * @return bool
     */
    public function isCloseable(): bool
    {
        return $this->isCloseable;
    }
    
    /**
     * @return bool
     */
    public function isSendingEmail(): bool
    {
        return $this->isSendingEmail;
    }
    
    /**
     * @return string
     */
    public function getColorCode(): string
    {
        return $this->colorCode;
    }
    
    /**
     * @return array
     */
    public function getNames(): array
    {
        return $this->names;
    }
    
    /**
     * @return array
     */
    public function getEmailSubjects(): array
    {
        return $this->emailSubjects;
    }
    
    /**
     * @return array
     */
    public function getEmailBodies(): array
    {
        return $this->emailBodies;
    }
}
