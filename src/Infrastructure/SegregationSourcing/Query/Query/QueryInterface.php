<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Query;

use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

interface QueryInterface extends MessageInterface
{
    /**
     * @return Viewable
     */
    public function getView();
    
    /**
     * @param Viewable $view
     */
    public function setView(Viewable $view): void;
    
    /**
     * @return ViewableCollection
     */
    public function getViewCollection();
    
    /**
     * @param ViewableCollection $viewCollection
     */
    public function setViewCollection(ViewableCollection $viewCollection): void;
    
    /**
     * @param bool $storeExceptions
     */
    public function silentException(bool $storeExceptions = true): void;
    
    /**
     * @return \Exception
     */
    public function exception(): \Exception;
    
    /**
     * @param \Exception $exception
     */
    public function setException(\Exception $exception): void;
    
    /**
     * @return bool
     */
    public function hasException(): bool;
}
