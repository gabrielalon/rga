<?php
namespace RGA\Infrastructure\Persist\Exception;

class NotFound extends \RuntimeException
{
    /**
     * @var string
     */
    private $entityName;
    /**
     * @var string
     */
    private $key;

    /**
     * @param string $entityName
     * @param string $key
     */
    public function __construct(string $entityName, string $key)
    {
        $message = 'Entity not found';
        parent::__construct($message);
        $this->entityName = $entityName;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->entityName;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}