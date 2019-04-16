<?php

namespace RGA\Application\Rga\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface RgaPackageDataProvider extends DataProviderInterface
{
    /**
     * @return string
     */
    public function packageNo(): string;
    
    /**
     * @return \DateTimeImmutable
     */
    public function setAt(): \DateTimeImmutable;
}
