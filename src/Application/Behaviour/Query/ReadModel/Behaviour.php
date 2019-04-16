<?php

namespace RGA\Application\Behaviour\Query\ReadModel;

use RGA\Domain\Model\Behaviour\Behaviour as VO;
use RGA\Infrastructure\SegregationSourcing;

class Behaviour implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Uuid */
    private $identifier;
    
    /** @var VO\Type */
    private $type;
    
    /** @var VO\Active */
    private $active;
    
    /** @var VO\Names */
    private $names;
    
    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setIdentifier(VO\Uuid::fromString($uuid));
    }
    
    /**
     * @param string $uuid
     * @return Behaviour
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
     * @param VO\Uuid $identifier
     * @return Behaviour
     */
    public function setIdentifier(VO\Uuid $identifier): Behaviour
    {
        $this->identifier = $identifier;
        
        return $this;
    }
    
    /**
     * @return VO\Uuid
     */
    public function getIdentifier(): VO\Uuid
    {
        return $this->identifier;
    }
    
    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type->toString();
    }
    
    /**
     * @param VO\Type $type
     * @return Behaviour
     */
    public function setType(VO\Type $type): Behaviour
    {
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * @return VO\Type
     */
    public function getType(): VO\Type
    {
        return $this->type;
    }
    
    /**
     * @return bool
     */
    public function active(): bool
    {
        return (bool)$this->active->toString();
    }
    
    /**
     * @param VO\Active $isActive
     * @return Behaviour
     */
    public function setActivation(VO\Active $isActive): Behaviour
    {
        $this->active = $isActive;
        
        return $this;
    }
    
    /**
     * @return VO\Active
     */
    public function getActive(): VO\Active
    {
        return $this->active;
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
     * @param string $locale
     * @param string $name
     * @return Behaviour
     */
    public function addName(string $locale, string $name): Behaviour
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
     * @return Behaviour
     */
    public function setNames(VO\Names $names): Behaviour
    {
        $this->names = $names;
        
        return $this;
    }
    
    /**
     * @return VO\Names
     */
    public function getNames(): VO\Names
    {
        return $this->names;
    }
}
