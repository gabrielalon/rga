<?php

namespace RGA\Application\ReturnPackage\Query\ReadModel;

use RGA\Domain\Model\ReturnPackage\ReturnPackage as VO;
use RGA\Domain\Model\Transport\Transport as VOTransport;
use RGA\Infrastructure\SegregationSourcing;

class ReturnPackage implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Id */
    private $identifier;
    
    /** @var VO\RgaUuid */
    private $rgaUuid;
    
    /** @var VO\TransportUuid */
    private $transportUuid;
    
    /** @var VOTransport\Names */
    private $transportNames;
    
    /** @var VO\NettPrice */
    private $nettPrice;
    
    /** @var VO\VatRate */
    private $vatRate;
    
    /** @var VO\Currency */
    private $currency;
    
    /** @var VO\PackageSent */
    private $packageSent;
    
    /** @var VO\PackageNo */
    private $packageNo;
    
    /** @var VO\PackageSentAt */
    private $packageSentAt;
    
    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->setIdentifier(VO\Id::fromInteger($id));
    }
    
    /**
     * @param int $id
     * @return ReturnPackage
     */
    public static function fromId($id): self
    {
        return new static($id);
    }
    
    /**
     * {@inheritdoc}
     */
    public function identifier()
    {
        return $this->identifier->toString();
    }
    
    /**
     * @return VO\Id
     */
    public function getIdentifier(): VO\Id
    {
        return $this->identifier;
    }
    
    /**
     * @param VO\Id $identifier
     * @return ReturnPackage
     */
    public function setIdentifier(VO\Id $identifier): ReturnPackage
    {
        $this->identifier = $identifier;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function rgaUuid(): string
    {
        return $this->rgaUuid->toString();
    }
    
    /**
     * @return VO\RgaUuid
     */
    public function getRgaUuid(): VO\RgaUuid
    {
        return $this->rgaUuid;
    }
    
    /**
     * @param VO\RgaUuid $rgaUuid
     * @return ReturnPackage
     */
    public function setRgaUuid(VO\RgaUuid $rgaUuid): ReturnPackage
    {
        $this->rgaUuid = $rgaUuid;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function transportUuid(): string
    {
        return $this->transportUuid->toString();
    }
    
    /**
     * @return VO\TransportUuid
     */
    public function getTransportUuid(): VO\TransportUuid
    {
        return $this->transportUuid;
    }
    
    /**
     * @param VO\TransportUuid $transportUuid
     * @return ReturnPackage
     */
    public function setTransportUuid(VO\TransportUuid $transportUuid): ReturnPackage
    {
        $this->transportUuid = $transportUuid;
        
        return $this;
    }
    
    /**
     * @param string $locale
     * @return string
     */
    public function transportName(string $locale): string
    {
        return $this->transportNames->getLocale($locale)->toString();
    }
    
    /**
     * @return array
     */
    public function transportNames(): array
    {
        return $this->transportNames->raw();
    }
    
    /**
     * @return VOTransport\Names
     */
    public function getTransportNames(): VOTransport\Names
    {
        return $this->transportNames;
    }
    
    /**
     * @param string $locale
     * @param string $name
     * @return ReturnPackage
     */
    public function addTransportName(string $locale, ?string $name): ReturnPackage
    {
        $name = $name ?? '';
        if (null === $this->transportNames) {
            $this->setTransportNames(VOTransport\Names::fromArray([
                $locale => $name
            ]));
        } else {
            $this->transportNames->addLocale($locale, $name);
        }
        
        return $this;
    }
    
    /**
     * @param VOTransport\Names $transportNames
     * @return ReturnPackage
     */
    public function setTransportNames(VOTransport\Names $transportNames): ReturnPackage
    {
        $this->transportNames = $transportNames;
        
        return $this;
    }
    
    /**
     * @return float
     */
    public function nettPrice(): float
    {
        return (float)$this->nettPrice->toString();
    }
    
    /**
     * @return VO\NettPrice
     */
    public function getNettPrice(): VO\NettPrice
    {
        return $this->nettPrice;
    }
    
    /**
     * @param VO\NettPrice $nettPrice
     * @return ReturnPackage
     */
    public function setNettPrice(VO\NettPrice $nettPrice): ReturnPackage
    {
        $this->nettPrice = $nettPrice;
        
        return $this;
    }
    
    /**
     * @return float
     */
    public function grossPrice(): float
    {
        return $this->nettPrice() * (1 + $this->vatRate() / 100);
    }
    
    /**
     * @return int
     */
    public function vatRate(): int
    {
        return (int)$this->vatRate->toString();
    }
    
    /**
     * @return VO\VatRate
     */
    public function getVatRate(): VO\VatRate
    {
        return $this->vatRate;
    }
    
    /**
     * @param VO\VatRate $vatRate
     * @return ReturnPackage
     */
    public function setVatRate(VO\VatRate $vatRate): ReturnPackage
    {
        $this->vatRate = $vatRate;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency->toString();
    }
    
    /**
     * @return VO\Currency
     */
    public function getCurrency(): VO\Currency
    {
        return $this->currency;
    }
    
    /**
     * @param VO\Currency $currency
     * @return ReturnPackage
     */
    public function setCurrency(VO\Currency $currency): ReturnPackage
    {
        $this->currency = $currency;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function packageSent(): bool
    {
        return (bool)$this->packageSent->toString();
    }
    
    /**
     * @return VO\PackageSent
     */
    public function getPackageSent(): VO\PackageSent
    {
        return $this->packageSent;
    }
    
    /**
     * @param VO\PackageSent $packageSent
     * @return ReturnPackage
     */
    public function setPackageSent(VO\PackageSent $packageSent): ReturnPackage
    {
        $this->packageSent = $packageSent;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function packageNo(): string
    {
        return $this->packageNo->toString();
    }
    
    /**
     * @return VO\PackageNo
     */
    public function getPackageNo(): VO\PackageNo
    {
        return $this->packageNo;
    }
    
    /**
     * @param VO\PackageNo $packageNo
     * @return ReturnPackage
     */
    public function setPackageNo(VO\PackageNo $packageNo): ReturnPackage
    {
        $this->packageNo = $packageNo;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function packageSentAt(): string
    {
        return $this->packageSentAt->toString();
    }
    
    /**
     * @return VO\PackageSentAt
     */
    public function getPackageSentAt(): VO\PackageSentAt
    {
        return $this->packageSentAt;
    }
    
    /**
     * @param VO\PackageSentAt $packageSentAt
     * @return ReturnPackage
     */
    public function setPackageSentAt(VO\PackageSentAt $packageSentAt): ReturnPackage
    {
        $this->packageSentAt = $packageSentAt;
        
        return $this;
    }
}
