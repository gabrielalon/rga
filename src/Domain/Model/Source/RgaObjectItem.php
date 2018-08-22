<?php

namespace RGA\Domain\Model\Source;

use RGA\Infrastructure\Source\RgaObject\RgaObjectItemInterface;

class RgaObjectItem
	implements RgaObjectItemInterface
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
	private $finalDateOfComplaint;
	
	/** @var integer */
	private $finalDateOfReturn;
	
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
	public function __construct($id, $variantId, $name, $type, $objectId, $finalDateOfComplaint = null, $finalDateOfReturn = null, $warranty = null)
	{
		$this->id = $id;
		$this->variantId = $variantId;
		$this->name = $name;
		$this->type = $type;
		$this->objectId = $objectId;
		$this->finalDateOfComplaint = $finalDateOfComplaint;
		$this->finalDateOfReturn = $finalDateOfReturn;
		$this->warranty = $warranty;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @return integer
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @return integer
	 */
	public function getVariantId(): int
	{
		return $this->variantId;
	}
	
	/**
	 * @return boolean
	 */
	public function isTransport(): bool
	{
		return $this->type === 'transport';
	}
	
	/**
	 * @return integer
	 */
	public function getObjectId(): int
	{
		return $this->objectId;
	}
	
	/**
	 * @return int
	 */
	public function getFinalDateOfComplaint(): ?int
	{
		return $this->finalDateOfComplaint;
	}
	
	/**
	 * @return int
	 */
	public function getFinalDateOfReturn(): ?int
	{
		return $this->finalDateOfReturn;
	}
	
	/**
	 * @return int|null
	 */
	public function getWarranty(): ?int
	{
		return $this->warranty;
	}
}