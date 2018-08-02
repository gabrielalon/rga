<?php

namespace RGA\Domain\ValueObject\Applicant;

class Applicant
{
	/** @var integer */
	private $id;
	
	/** @var string */
	private $type;
	
	/**
	 * @param int $id
	 * @param string $type
	 */
	public function __construct($id, $type)
	{
		$this->id = $id;
		$this->type = $type;
	}
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
}