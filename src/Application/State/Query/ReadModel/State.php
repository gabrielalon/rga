<?php

namespace RGA\Application\State\Query\ReadModel;

use RGA\Domain\Model\State\State as VO;
use RGA\Infrastructure\SegregationSourcing;

class State implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Uuid */
    private $identifier;
    
    /** @var VO\IsEditable */
    private $isEditable;
    
    /** @var VO\IsDeletable */
    private $isDeletable;
    
    /** @var VO\IsRejectable */
    private $isRejectable;
    
    /** @var VO\IsFinishable */
    private $isFinishable;
    
    /** @var VO\IsCloseable */
    private $isCloseable;
    
    /** @var VO\IsSendingEmail */
    private $isSendingEmail;
    
    /** @var VO\ColorCode */
    private $colorCode;
    
    /** @var VO\Names */
    private $names;
    
    /** @var VO\EmailSubjects */
    private $emailSubjects;
    
    /** @var VO\EmailBodies */
    private $emailBodies;
    
    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setIdentifier(VO\Uuid::fromString($uuid));
    }
    
    /**
     * @param string $uuid
     * @return State
     */
    public static function fromUuid(string $uuid): self
    {
        return new static($uuid);
    }
    
    /**
     * @return string
     */
    public function identifier(): string
    {
        return $this->identifier->toString();
    }
    
    /**
     * @return VO\Uuid
     */
    public function getIdentifier(): VO\Uuid
    {
        return $this->identifier;
    }
    
    /**
     * @param VO\Uuid $identifier
     * @return State
     */
    public function setIdentifier(VO\Uuid $identifier): State
    {
        $this->identifier = $identifier;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return (bool)$this->isEditable->toString();
    }
    
    /**
     * @return VO\IsEditable
     */
    public function getIsEditable(): VO\IsEditable
    {
        return $this->isEditable;
    }
    
    /**
     * @param VO\IsEditable $isEditable
     * @return State
     */
    public function setIsEditable(VO\IsEditable $isEditable): State
    {
        $this->isEditable = $isEditable;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isDeletable(): bool
    {
        return (bool)$this->isDeletable->toString();
    }
    
    /**
     * @return VO\IsDeletable
     */
    public function getIsDeletable(): VO\IsDeletable
    {
        return $this->isDeletable;
    }
    
    /**
     * @param VO\IsDeletable $isDeletable
     * @return State
     */
    public function setIsDeletable(VO\IsDeletable $isDeletable): State
    {
        $this->isDeletable = $isDeletable;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isRejectable(): bool
    {
        return (bool)$this->isRejectable->toString();
    }
    
    /**
     * @return VO\IsRejectable
     */
    public function getIsRejectable(): VO\IsRejectable
    {
        return $this->isRejectable;
    }
    
    /**
     * @param VO\IsRejectable $isRejectable
     * @return State
     */
    public function setIsRejectable(VO\IsRejectable $isRejectable): State
    {
        $this->isRejectable = $isRejectable;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isFinishable(): bool
    {
        return (bool)$this->isFinishable->toString();
    }
    
    /**
     * @return VO\IsFinishable
     */
    public function getIsFinishable(): VO\IsFinishable
    {
        return $this->isFinishable;
    }
    
    /**
     * @param VO\IsFinishable $isFinishable
     * @return State
     */
    public function setIsFinishable(VO\IsFinishable $isFinishable): State
    {
        $this->isFinishable = $isFinishable;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isCloseable(): bool
    {
        return (bool)$this->isCloseable->toString();
    }
    
    /**
     * @return VO\IsCloseable
     */
    public function getIsCloseable(): VO\IsCloseable
    {
        return $this->isCloseable;
    }
    
    /**
     * @param VO\IsCloseable $isCloseable
     * @return State
     */
    public function setIsCloseable(VO\IsCloseable $isCloseable): State
    {
        $this->isCloseable = $isCloseable;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isSendingEmail(): bool
    {
        return (bool)$this->isSendingEmail->toString();
    }
    
    /**
     * @return VO\IsSendingEmail
     */
    public function getIsSendingEmail(): VO\IsSendingEmail
    {
        return $this->isSendingEmail;
    }
    
    /**
     * @param VO\IsSendingEmail $isSendingEmail
     * @return State
     */
    public function setIsSendingEmail(VO\IsSendingEmail $isSendingEmail): State
    {
        $this->isSendingEmail = $isSendingEmail;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function colorCode(): string
    {
        return $this->colorCode->toString();
    }
    
    /**
     * @return VO\ColorCode
     */
    public function getColorCode(): VO\ColorCode
    {
        return $this->colorCode;
    }
    
    /**
     * @param VO\ColorCode $colorCode
     * @return State
     */
    public function setColorCode(VO\ColorCode $colorCode): State
    {
        $this->colorCode = $colorCode;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function name(string $locale): string
    {
        return $this->names->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function names(): array
    {
        return $this->names->raw();
    }
    
    /**
     * @return VO\Names
     */
    public function getNames(): VO\Names
    {
        return $this->names;
    }
    
    /**
     * @param string $locale
     * @param string $name
     * @return State
     */
    public function addName(string $locale, string $name): State
    {
        if (null === $this->names) {
            $this->setNames(VO\Names::fromArray([
                $locale => $name
            ]));
        } else {
            $this->names->addLocale($locale, $name);
        }
        
        return $this;
    }
    
    /**
     * @param VO\Names $names
     * @return State
     */
    public function setNames(VO\Names $names): State
    {
        $this->names = $names;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function getName(string $locale): string
    {
        return $this->names->getLocale($locale)->toString();
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function emailSubject(string $locale): string
    {
        return $this->emailSubjects->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function emailSubjects(): array
    {
        return $this->emailSubjects->raw();
    }
    
    /**
     * @return VO\EmailSubjects
     */
    public function getEmailSubjects(): VO\EmailSubjects
    {
        return $this->emailSubjects;
    }
    
    /**
     * @param string $locale
     * @param string $emailSubject
     * @return State
     */
    public function addEmailSubject(string $locale, string $emailSubject): State
    {
        if (null === $this->emailSubjects) {
            $this->setEmailSubjects(VO\EmailSubjects::fromArray([
                $locale => $emailSubject
            ]));
        } else {
            $this->emailSubjects->addLocale($locale, $emailSubject);
        }
        
        return $this;
    }
    
    /**
     * @param VO\EmailSubjects $emailSubjects
     * @return State
     */
    public function setEmailSubjects(VO\EmailSubjects $emailSubjects): State
    {
        $this->emailSubjects = $emailSubjects;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function getEmailSubject(string $locale): string
    {
        return $this->emailSubjects->getLocale($locale)->toString();
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function emailBody(string $locale): string
    {
        return $this->emailBodies->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function emailBodies(): array
    {
        return $this->emailBodies->raw();
    }
    
    /**
     * @return VO\EmailBodies
     */
    public function getEmailBodies(): VO\EmailBodies
    {
        return $this->emailBodies;
    }
    
    /**
     * @param string $locale
     * @param string $emailBody
     * @return State
     */
    public function addEmailBody(string $locale, string $emailBody): State
    {
        if (null === $this->emailBodies) {
            $this->setEmailBodies(VO\EmailBodies::fromArray([
                $locale => $emailBody
            ]));
        } else {
            $this->emailBodies->addLocale($locale, $emailBody);
        }
        
        return $this;
    }
    
    /**
     * @param VO\EmailBodies $emailBodies
     * @return State
     */
    public function setEmailBodies(VO\EmailBodies $emailBodies): State
    {
        $this->emailBodies = $emailBodies;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function getEmailBody(string $locale): string
    {
        return $this->emailBodies->getLocale($locale)->toString();
    }
}
