<?php

namespace RGA\Application\Attachment\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface AttachmentDataProvider extends DataProviderInterface
{
    /**
     * @return string
     */
    public function rgaUuid(): string;
    
    /**
     * @return string
     */
    public function fileType(): string;
    
    /**
     * @return string
     */
    public function fileName(): string;
    
    /**
     * @return string
     */
    public function originalFileName(): string;
}
