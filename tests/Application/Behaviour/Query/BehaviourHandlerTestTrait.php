<?php


namespace RGA\Test\Application\Behaviour\Query;

use RGA\Application\Behaviour\Query\ReadModel\Behaviour;
use RGA\Domain\Model\Behaviour\Behaviour as VO;

trait BehaviourHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @param string $type
	 * @return Behaviour
	 */
	protected function createBehaviourView(string $uuid, string $type): Behaviour
	{
		return Behaviour::fromUuid($uuid)
			->setActivation(VO\Active::fromBoolean(true))
			->setType(VO\Type::fromString($type))
		;
	}
}