<?php

namespace RGA\Domain\Model\Rga\Rga\Applicant;

class Bank
{
    /** @var string */
    private $name;
    
    /** @var string */
    private $accountNumber;
    
    /**
     * @param string $name
     * @param string $accountNumber
     */
    public function __construct($name, $accountNumber)
    {
        $this->name = $name;
        $this->accountNumber = $accountNumber;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }
}
