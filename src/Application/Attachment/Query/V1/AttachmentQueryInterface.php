<?php

namespace RGA\Application\Attachment\Query\V1;

interface AttachmentQueryInterface
{
    /**
     * @param FindOneByUuid $query
     */
    public function findOneByUuid(FindOneByUuid $query): void;
    
    /**
     * @param FindAllByRgaUuid $query
     */
    public function findAllByRgaUuid(FindAllByRgaUuid $query): void;
    
    /**
     * @param FindAll $query
     */
    public function findAll(FindAll $query): void;
}
