<?php

namespace RGA\Test\Mock\Domain\Model\Behaviour;

use RGA\Application\Enum\Behaviour\BehaviourType;
use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Domain\ValueObject;

class ComplaintBehaviour
	extends Behaviour
{
	public function __construct()
	{
		$this->setUuid('69ac376b-aab9-4987-b586-5292266c3e7c');
		$this->setIsActive(new ValueObject\Behaviour\IsActive(true));
		$this->setType(new ValueObject\Behaviour\Type(BehaviourType::COMPLAINT_TYPE));
	}
}