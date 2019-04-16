<?php

namespace RGA\Application\Attachment\Query\ReadModel;

use RGA\Domain\Model\Attachment\Attachment as VO;
use RGA\Infrastructure\SegregationSourcing;

class Attachment implements SegregationSourcing\Query\Query\Viewable
{
    /** @var VO\Uuid */
    private $identifier;
    
    /** @var VO\RgaUuid */
    private $rgaUuid;
    
    /** @var VO\FileType */
    private $fileType;
    
    /** @var VO\FileName */
    private $fileName;
    
    /** @var VO\OriginalFileName */
    private $originalFileName;
    
    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setIdentifier(VO\Uuid::fromString($uuid));
    }
    
    /**
     * @param string $uuid
     * @return Attachment
     */
    public static function fromUuid(string $uuid): Attachment
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
     * @return Attachment
     */
    public function setIdentifier(VO\Uuid $identifier): Attachment
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
     * @return Attachment
     */
    public function setRgaUuid(VO\RgaUuid $rgaUuid): Attachment
    {
        $this->rgaUuid = $rgaUuid;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function fileType(): string
    {
        return $this->fileType->toString();
    }
    
    /**
     * @return VO\FileType
     */
    public function getFileType(): VO\FileType
    {
        return $this->fileType;
    }
    
    /**
     * @param VO\FileType $fileType
     * @return Attachment
     */
    public function setFileType(VO\FileType $fileType): Attachment
    {
        $this->fileType = $fileType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function fileName(): string
    {
        return $this->fileName->toString();
    }
    
    /**
     * @return VO\FileName
     */
    public function getFileName(): VO\FileName
    {
        return $this->fileName;
    }
    
    /**
     * @param VO\FileName $fileName
     * @return Attachment
     */
    public function setFileName(VO\FileName $fileName): Attachment
    {
        $this->fileName = $fileName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function originalFileName(): string
    {
        return $this->originalFileName->toString();
    }
    
    /**
     * @return VO\OriginalFileName
     */
    public function getOriginalFileName(): VO\OriginalFileName
    {
        return $this->originalFileName;
    }
    
    /**
     * @param VO\OriginalFileName $originalFileName
     * @return Attachment
     */
    public function setOriginalFileName(VO\OriginalFileName $originalFileName): Attachment
    {
        $this->originalFileName = $originalFileName;
        
        return $this;
    }
}
