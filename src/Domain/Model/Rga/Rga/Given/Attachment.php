<?php

namespace RGA\Domain\Model\Rga\Rga\Given;

class Attachment
{
    /** @var string */
    private $fileType;
    
    /** @var string */
    private $fileName;
    
    /** @var string */
    private $fileOriginalName;
    
    /**
     * @param string $fileType
     * @param string $fileName
     * @param string $fileOriginalName
     */
    public function __construct(string $fileType, string $fileName, string $fileOriginalName)
    {
        $this->fileType = $fileType;
        $this->fileName = $fileName;
        $this->fileOriginalName = $fileOriginalName;
    }
    
    /**
     * @return string
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }
    
    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }
    
    /**
     * @return string
     */
    public function getFileOriginalName(): string
    {
        return $this->fileOriginalName;
    }
}
