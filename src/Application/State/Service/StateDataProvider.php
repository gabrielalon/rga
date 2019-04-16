<?php

namespace RGA\Application\State\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface StateDataProvider extends DataProviderInterface
{
    /**
     * @return bool
     */
    public function editable(): bool;
    
    /**
     * @return bool
     */
    public function deletable(): bool;
    
    /**
     * @return bool
     */
    public function rejectable(): bool;
    
    /**
     * @return bool
     */
    public function finishable(): bool;
    
    /**
     * @return bool
     */
    public function closeable(): bool;
    
    /**
     * @return bool
     */
    public function sendsEmail(): bool;
    
    /**
     * @return string
     */
    public function colorCode(): string;
    
    /**
     * @return array
     */
    public function names(): array;
    
    /**
     * @return array
     */
    public function emailSubjects(): array;
    
    /**
     * @return array
     */
    public function emailBody(): array;
}
