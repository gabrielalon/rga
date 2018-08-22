<?php

namespace RGA\Domain\Model\Source;

class RgaObjectItemBuilder
{
	/** @var integer */
	private $id;
	
	/** @var integer */
	private $variantId;
	
	/** @var integer */
	private $objectId;
	
	/** @var string */
	private $objectName;
	
	/** @var string */
	private $objectType;
	
	/** @var integer */
	private $warranty;
	
	/**
	 * @param $id
	 * @param $variantId
	 * @param $objectName
	 * @param $objectType
	 * @param $objectId
	 * @param integer $warranty
	 */
	public function __construct($id, $variantId, $objectName, $objectType, $objectId, $warranty)
	{
		$this->id = $id;
		$this->variantId = $variantId;
		$this->objectName = $objectName;
		$this->objectType = $objectType;
		$this->objectId = $objectId;
		$this->warranty = $warranty;
	}
	
	/**
	 * @return RgaObjectItem
	 */
	public function build()
	{
		return new RgaObjectItem(
			$this->id,
			$this->variantId,
			$this->objectName,
			$this->objectType,
			$this->objectId,
			$this->warranty
		);
	}
}