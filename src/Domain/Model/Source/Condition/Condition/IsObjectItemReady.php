<?php

namespace RGA\Domain\Model\Source\Condition\Condition;

use RGA\Application\Assert;
use RGA\Application\Rga\Integration;
use RGA\Application\Behaviour\Enum;
use RGA\Domain\Model;
use RGA\Infrastructure\Source;

class IsObjectItemReady
	extends Assert\Assertion
{
	const INVALID_DATE_IS_MET = 901;
	
	/** @var Model\Source\RgaObjectItem */
	private $sourceObjectItem;
	
	/** @var Integration\Warranty\Calculator */
	private $warrantyCalculator;
	
	/**
	 * @param Model\Source\RgaObjectItem $sourceObjectItem
	 * @param Integration\Warranty\Calculator $warrantyCalculator
	 */
	public function __construct(
		Model\Source\RgaObjectItem $sourceObjectItem,
		Integration\Warranty\Calculator $warrantyCalculator
	)
	{
		$this->sourceObjectItem = $sourceObjectItem;
		$this->warrantyCalculator = $warrantyCalculator;
	}
	
	
	/**
	 * @param string $behaviourType
	 * @return bool
	 */
	public function dateIsMet($behaviourType): bool
	{
		if ($behaviourType === Enum\Type::RETURN)
		{
			return $this->getFinalDateOfReturn() >= time();
		}
		
		if ($behaviourType === Enum\Type::COMPLAINT)
		{
			return $this->getFinalDateOfComplaint() >= time();
		}
		
		return true;
	}
	
	/**
	 * @return int|null
	 */
	private function getFinalDateOfReturn(): ?int
	{
		if (null === $this->sourceObjectItem->getFinalDateOfReturn())
		{
			return $this->warrantyCalculator->getFinalDateOfReturn();
		}
		
		return $this->sourceObjectItem->getFinalDateOfReturn();
	}
	
	/**
	 * @return int|null
	 */
	private function getFinalDateOfComplaint(): ?int
	{
		if (null === $this->sourceObjectItem->getFinalDateOfComplaint())
		{
			return $this->warrantyCalculator->getFinalDateOfComplaint($this->sourceObjectItem->getWarranty());
		}
		
		return $this->sourceObjectItem->getFinalDateOfComplaint();
	}
	
	/**
	 * @param string $behaviourType
	 * @param Model\Source\RgaObjectItem $source
	 * @param Integration\Warranty\Calculator $warrantyCalculator
	 * @throws Assert\Exception\AssertionFailedException
	 */
	public static function assert($behaviourType, Model\Source\RgaObjectItem $source, Integration\Warranty\Calculator $warrantyCalculator): void
	{
		$condition = new static($source, $warrantyCalculator);
		
		if (false === $condition->dateIsMet($behaviourType))
		{
			$message = static::generateMessage('Period has passed for object item to return');
			throw static::createException($source, $message, self::INVALID_DATE_IS_MET);
		}
	}
}