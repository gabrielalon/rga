<?php

namespace RGA\Application\Source\Query;

use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class GetOne
	extends QueryMessage
{
	/** @var int|string */
	private $id;
	
	/** @var string */
	private $type;
	
	/** @var int|string */
	private $givenId;
	
	/** @var RgaObject */
	private $object;
	
	public function __construct()
	{
		$this->init();
	}
	
	/**
	 * @return int|string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param int|string $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param string $type
	 */
	public function setType($type): void
	{
		$this->type = $type;
	}
	
	/**
	 * @return int|string
	 */
	public function getGivenId()
	{
		return $this->givenId;
	}
	
	/**
	 * @param int|string $givenId
	 */
	public function setGivenId($givenId): void
	{
		$this->givenId = $givenId;
	}
	
	/**
	 * @return RgaObject
	 */
	public function getObject(): RgaObject
	{
		return $this->object;
	}
	
	/**
	 * @param RgaObject $object
	 */
	public function setObject(RgaObject $object): void
	{
		$this->object = $object;
	}
}