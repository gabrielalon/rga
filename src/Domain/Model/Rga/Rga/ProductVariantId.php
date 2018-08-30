<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ProductVariantId
{
	/** @var integer */
	private $id;
	
	/**
	 * @param integer $id
	 * @return ProductVariantId
	 */
	public static function fromInteger(int $id): ProductVariantId
	{
		return new ProductVariantId($id);
	}
	
	/**
	 * @param integer $id
	 */
	private function __construct(int $id)
	{
		Assertion::integer($id, 'Invalid ProductVariantId integer: ' . $id);
		
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->id;
	}
	
	/**
	 * @param ProductVariantId $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ProductVariantId)
		{
			return false;
		}
		
		return $this->id === $other->id;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->id;
	}
}