<?php

namespace RGA\Test\Mock\Domain\Model\Behaviour;

use RGA\Application\Enum\Behaviour\BehaviourType;
use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Domain\ValueObject;

class ReturnBehaviour
	extends Behaviour
{
	public function __construct()
	{
		$this->setUuid('f8691304-6043-4974-aae9-5dbf54a86d1e');
		$this->setIsActive(new ValueObject\Behaviour\IsActive(true));
		$this->setType(new ValueObject\Behaviour\Type(BehaviourType::RETURN_TYPE));
	}
}