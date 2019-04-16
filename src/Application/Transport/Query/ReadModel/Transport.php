<?php

namespace RGA\Application\Transport\Query\ReadModel;

use RGA\Domain\Model\Transport\Transport as VO;
use RGA\Infrastructure\SegregationSourcing;

class Transport implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Uuid */
    private $identifier;
    
    /** @var VO\Active */
    private $active;
    
    /** @var VO\ShipmentId */
    private $shipmentId;
    
    /** @var VO\Domains */
    private $domains;
    
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
     * @return Transport
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
     * @return Transport
     */
    public function setIdentifier(VO\Uuid $identifier): Transport
    {
        $this->identifier = $identifier;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function active(): bool
    {
        return (bool)$this->active->toString();
    }
    
    /**
     * @return VO\Active
     */
    public function getActive(): VO\Active
    {
        return $this->active;
    }
    
    /**
     * @param VO\Active $active
     * @return Transport
     */
    public function setActive(VO\Active $active): Transport
    {
        $this->active = $active;
        
        return $this;
    }
    
    /**
     * @return integer
     */
    public function shipmentId(): int
    {
        return (int)$this->shipmentId->toString();
    }
    
    /**
     * @return VO\ShipmentId
     */
    public function getShipmentId(): VO\ShipmentId
    {
        return $this->shipmentId;
    }
    
    /**
     * @param VO\ShipmentId $shipmentId
     * @return Transport
     */
    public function setShipmentId(VO\ShipmentId $shipmentId): Transport
    {
        $this->shipmentId = $shipmentId;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function domains(): array
    {
        return $this->domains->raw();
    }
    
    /**
     * @return VO\Domains
     */
    public function getDomains(): VO\Domains
    {
        return $this->domains;
    }
    
    /**
     * @param string $domain
     * @return Transport
     */
    public function addDomain(string $domain): Transport
    {
        if (null === $this->domains) {
            $this->setDomains(VO\Domains::fromArray([$domain]));
        } else {
            $this->domains->addDomain($domain);
        }
        
        return $this;
    }
    
    /**
     * @param array $domains
     * @return Transport
     */
    public function addDomains(array $domains = []): Transport
    {
        foreach ($domains as $domain) {
            $this->addDomain($domain);
        }
        
        return $this;
    }
    
    /**
     * @param VO\Domains $domains
     * @return Transport
     */
    public function setDomains(VO\Domains $domains): Transport
    {
        $this->domains = $domains;
        
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
     * @return Transport
     */
    public function addName(string $locale, string $name): Transport
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
     * @return Transport
     */
    public function setNames(VO\Names $names): Transport
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
}
