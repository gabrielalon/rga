<?php

namespace RGA\Domain\Model\State;

use RGA\Domain\Model\State\State as VO;
use RGA\Application\State\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class State extends Aggregate\AggregateRoot
{
    /** @var VO\Uuid */
    protected $uuid;
    
    /** @var VO\IsEditable */
    protected $isEditable;
    
    /** @var VO\IsDeletable */
    protected $isDeletable;
    
    /** @var VO\IsRejectable */
    protected $isRejectable;
    
    /** @var VO\IsFinishable */
    protected $isFinishable;
    
    /** @var VO\IsCloseable */
    protected $isCloseable;
    
    /** @var VO\IsSendingEmail */
    protected $isSendingEmail;
    
    /** @var VO\ColorCode */
    protected $colorCode;
    
    /** @var VO\Names */
    protected $names;
    
    /** @var VO\EmailSubjects */
    protected $emailSubjects;
    
    /** @var VO\EmailBodies */
    protected $emailBodies;
    
    /**
     * @param State\Uuid $uuid
     * @return State
     */
    public function setUuid(State\Uuid $uuid): State
    {
        $this->uuid = $uuid;
        
        return $this;
    }
    
    /**
     * @param State\IsEditable $isEditable
     * @return State
     */
    public function setIsEditable(State\IsEditable $isEditable): State
    {
        $this->isEditable = $isEditable;
        
        return $this;
    }
    
    /**
     * @param State\IsDeletable $isDeletable
     * @return State
     */
    public function setIsDeletable(State\IsDeletable $isDeletable): State
    {
        $this->isDeletable = $isDeletable;
        
        return $this;
    }
    
    /**
     * @param State\IsRejectable $isRejectable
     * @return State
     */
    public function setIsRejectable(State\IsRejectable $isRejectable): State
    {
        $this->isRejectable = $isRejectable;
        
        return $this;
    }
    
    /**
     * @param State\IsFinishable $isFinishable
     * @return State
     */
    public function setIsFinishable(State\IsFinishable $isFinishable): State
    {
        $this->isFinishable = $isFinishable;
        
        return $this;
    }
    
    /**
     * @param State\IsCloseable $isCloseable
     * @return State
     */
    public function setIsCloseable(State\IsCloseable $isCloseable): State
    {
        $this->isCloseable = $isCloseable;
        
        return $this;
    }
    
    /**
     * @param State\IsSendingEmail $isSendingEmail
     * @return State
     */
    public function setIsSendingEmail(State\IsSendingEmail $isSendingEmail): State
    {
        $this->isSendingEmail = $isSendingEmail;
        
        return $this;
    }
    
    /**
     * @param State\ColorCode $colorCode
     * @return State
     */
    public function setColorCode(State\ColorCode $colorCode): State
    {
        $this->colorCode = $colorCode;
        
        return $this;
    }
    
    /**
     * @param State\Names $names
     * @return State
     */
    public function setNames(State\Names $names): State
    {
        $this->names = $names;
        
        return $this;
    }
    
    /**
     * @param State\EmailSubjects $emailSubjects
     * @return State
     */
    public function setEmailSubjects(State\EmailSubjects $emailSubjects): State
    {
        $this->emailSubjects = $emailSubjects;
        
        return $this;
    }
    
    /**
     * @param State\EmailBodies $emailBodies
     * @return State
     */
    public function setEmailBodies(State\EmailBodies $emailBodies): State
    {
        $this->emailBodies = $emailBodies;
        
        return $this;
    }
    
    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->uuid->toString();
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAggregateId($id): void
    {
        $this->setUuid(VO\Uuid::fromString($id));
    }
    
    /**
     * @param State\Uuid $uuid
     * @param State\IsEditable $isEditable
     * @param State\IsDeletable $isDeletable
     * @param State\IsRejectable $isRejectable
     * @param State\IsFinishable $isFinishable
     * @param State\IsCloseable $isCloseable
     * @param State\IsSendingEmail $isSendingEmail
     * @param State\ColorCode $colorCode
     * @param State\Names $names
     * @param State\EmailSubjects $emailSubjects
     * @param State\EmailBodies $emailBodies
     * @return State
     */
    public static function createNewState(
        VO\Uuid $uuid,
        VO\IsEditable $isEditable,
        VO\IsDeletable $isDeletable,
        VO\IsRejectable $isRejectable,
        VO\IsFinishable $isFinishable,
        VO\IsCloseable $isCloseable,
        VO\IsSendingEmail $isSendingEmail,
        VO\ColorCode $colorCode,
        VO\Names $names,
        VO\EmailSubjects $emailSubjects,
        VO\EmailBodies $emailBodies
    ): State {
        $state = new State();
        
        $state->recordThat(Event\NewStateCreated::occur($uuid->toString(), [
            'editable'       => $isEditable->toString(),
            'deletable'      => $isDeletable->toString(),
            'rejectable'     => $isRejectable->toString(),
            'finishable'     => $isFinishable->toString(),
            'closeable'      => $isCloseable->toString(),
            'sending_email'  => $isSendingEmail->toString(),
            'color_code'     => $colorCode->toString(),
            'names'          => $names->toString(),
            'email_subjects' => $emailSubjects->toString(),
            'email_bodies'   => $emailBodies->toString()
        ]));
        
        return $state;
    }
    
    /**
     * @param State\IsEditable $isEditable
     * @param State\IsDeletable $isDeletable
     * @param State\IsRejectable $isRejectable
     * @param State\IsFinishable $isFinishable
     * @param State\IsCloseable $isCloseable
     * @param State\IsSendingEmail $isSendingEmail
     * @param State\ColorCode $colorCode
     * @param State\Names $names
     * @param State\EmailSubjects $emailSubjects
     * @param State\EmailBodies $emailBodies
     */
    public function changeExistingState(
        VO\IsEditable $isEditable,
        VO\IsDeletable $isDeletable,
        VO\IsRejectable $isRejectable,
        VO\IsFinishable $isFinishable,
        VO\IsCloseable $isCloseable,
        VO\IsSendingEmail $isSendingEmail,
        VO\ColorCode $colorCode,
        VO\Names $names,
        VO\EmailSubjects $emailSubjects,
        VO\EmailBodies $emailBodies
    ): void {
        $this->recordThat(Event\ExistingStateChanged::occur($this->aggregateId(), [
            'editable'       => $isEditable->toString(),
            'deletable'      => $isDeletable->toString(),
            'rejectable'     => $isRejectable->toString(),
            'finishable'     => $isFinishable->toString(),
            'closeable'      => $isCloseable->toString(),
            'sending_email'  => $isSendingEmail->toString(),
            'color_code'     => $colorCode->toString(),
            'names'          => $names->toString(),
            'email_subjects' => $emailSubjects->toString(),
            'email_bodies'   => $emailBodies->toString()
        ]));
    }
    
    public function removeExistingState(): void
    {
        $this->recordThat(Event\ExistingStateRemoved::occur($this->aggregateId(), []));
    }
}
