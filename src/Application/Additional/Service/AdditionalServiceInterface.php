<?php

namespace RGA\Application\Additional\Service;

use RGA\Application\Rga\Service\RgaDataProvider;

interface AdditionalServiceInterface
{
    /**
     * @return string
     */
    public function getType(): string;
    
    /**
     * @return string
     */
    public function view(): string;
    
    /**
     * @param RgaDataProvider $provider
     * @param array $data
     */
    public function validate(RgaDataProvider $provider, array $data = []);
}
