<?php

namespace RGA\Application\Source\Condition;

use RGA\Application\Enum\Behaviour\BehaviourType;
use RGA\Application\Source\Warranty\Calculator;
use RGA\Domain\Model;
use RGA\Infrastructure\Source;

class IsReadyCondition
{
	/** @var Model\Source\RgaObject */
	private $object;
	
	/** @var Source\Warranty\ConfigInterface */
	private $config;
	
	/**
	 * @param Model\Source\RgaObject $object
	 * @param Source\Warranty\ConfigInterface $config
	 */
	public function __construct(
		Model\Source\RgaObject $object,
		Source\Warranty\ConfigInterface $config
	) {
		$this->object = $object;
		$this->config = $config;
	}
	
	/**
	 * @return bool
	 */
	public function isMet(): bool
	{
		$isCompleted = $this->object->hasCompletedState();
		$isPaid = $this->object->isPaid();
		
		return $isPaid && $isCompleted;
	}
	
	/**
	 * @param string $behaviourType
	 * @param integer $objectItemId
	 * @return bool
	 */
	public function dateIsMet($behaviourType, $objectItemId): bool
	{
		foreach ($this->object->getItems() as $rmaObjectItem)
		{
			if ($rmaObjectItem->getId() === $objectItemId)
			{
				if ($behaviourType === BehaviourType::RETURN_TYPE)
				{
					return $this->getFinalDateOfReturn($rmaObjectItem) >= time();
				}
				
				if ($behaviourType === BehaviourType::COMPLAINT_TYPE)
				{
					return $this->getFinalDateOfComplaint($rmaObjectItem) >= time();
				}
			}
		}
		
		return true;
	}
	
	/**
	 * @param Source\RgaObject\RgaObjectItemInterface $item
	 * @return int|null
	 */
	private function getFinalDateOfReturn(Source\RgaObject\RgaObjectItemInterface $item): ?int
	{
		if (null === $item->getFinalDateOfReturn())
		{
			$finalDateCalculator = new Calculator($this->config);
			
			return $finalDateCalculator->getFinalDateOfReturn($this->object->getCreatedAt());
		}
		
		return $item->getFinalDateOfReturn();
	}
	
	/**
	 * @param Source\RgaObject\RgaObjectItemInterface $item
	 * @return int|null
	 */
	private function getFinalDateOfComplaint(Source\RgaObject\RgaObjectItemInterface $item): ?int
	{
		if (null === $item->getFinalDateOfComplaint())
		{
			$finalDateCalculator = new Calculator($this->config);
			
			return $finalDateCalculator->getFinalDateOfComplaint($this->object->getCreatedAt(), $item->getWarranty());
		}
		
		return $item->getFinalDateOfComplaint();
	}
}