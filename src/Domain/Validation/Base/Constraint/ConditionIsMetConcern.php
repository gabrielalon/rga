<?php

namespace RGA\Domain\Validation\Base\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Application\Source\Condition\IsReadyCondition;
use RGA\Domain\Model;
use RGA\Infrastructure\Source\Warranty;

class ConditionIsMetConcern
	extends AbstractConstraint
{
	/** @var Model\Source\RgaObject */
	private $rga;
	
	/** @var string */
	private $behaviourType;
	
	/** @var Warranty\ConfigInterface */
	private $config;
	
	/**
	 * @param Model\Source\RgaObject $rga
	 * @param string $behaviourType
	 * @param Warranty\ConfigInterface $config
	 */
	public function __construct(
		Model\Source\RgaObject $rga,
		string $behaviourType,
		Warranty\ConfigInterface $config
	)
	{
		$this->rga = $rga;
		$this->behaviourType = $behaviourType;
		$this->config = $config;
	}
	
	public function run($objectItemId)
	{
		$condition = new IsReadyCondition($this->rga, $this->config);
		if (false === $condition->isMet())
		{
			$this->addError('object_is_not_ready_to_return');
		}
		
		if (false === $condition->dateIsMet($this->behaviourType, $objectItemId))
		{
			$this->addError("object_item_{$this->behaviourType}_period_has_passed");
		}
	}
}