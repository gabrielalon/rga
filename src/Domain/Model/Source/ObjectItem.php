<?php

namespace RGA\Domain\Model\Source;

use RGA\Infrastructure\Source\Object\ObjectItemInterface;

class ObjectItem
	implements ObjectItemInterface
{
	/** @var integer */
	private $id;
	
	/** @var integer */
	private $variantId;
	
	/** @var integer */
	private $objectId;
	
	/** @var string */
	private $name;
	
	/** @var string */
	private $type;
	
	/** @var integer */
	private $warranty;
	
	/**
	 * @param int $id
	 * @param int $variantId
	 * @param string $name
	 * @param string $type
	 * @param int $objectId
	 * @param int $warranty
	 */
	public function __construct($id, $variantId, $name, $type, $objectId, $warranty = null)
	{
		$this->id = $id;
		$this->variantId = $variantId;
		$this->name = $name;
		$this->type = $type;
		$this->objectId = $objectId;
		$this->warranty = $warranty;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return int
	 */
	public function getVariantId()
	{
		return $this->variantId;
	}
	
	/**
	 * @inheritDoc
	 */
	public function isTransport()
	{
		return $this->type === 'transport';
	}
	
	/**
	 * @return int
	 */
	public function getObjectId()
	{
		return $this->objectId;
	}
	
	/**
	 * @return int|null
	 */
	public function getWarranty()
	{
		return $this->warranty;
	}
}