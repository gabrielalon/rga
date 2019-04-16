<?php

namespace RGA\Application\Additional\Service;

use RGA\Application\Rga\Service\RgaDataProvider;

class EmptyAdditionalService implements AdditionalServiceInterface
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'empty';
    }
    
    /**
     * @return string
     */
    public function view(): string
    {
        return '';
    }
    
    /**
     * @param RgaDataProvider $provider
     * @param array $data
     */
    public function validate(RgaDataProvider $provider, array $data = [])
    {
    }
}
