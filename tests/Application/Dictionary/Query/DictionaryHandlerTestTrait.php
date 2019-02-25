<?php


namespace RGA\Test\Application\Dictionary\Query;

use RGA\Application\Dictionary\Query\ReadModel\Dictionary;
use RGA\Domain\Model\Dictionary\Dictionary as VO;

trait DictionaryHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @param string $behaviourUuid
	 * @param string $type
	 * @return Dictionary
	 */
	protected function createDictionary(string $uuid, string $behaviourUuid, string $type): Dictionary
	{
		return Dictionary::fromUuid($uuid)
			->addBehaviour($behaviourUuid)
			->setType(VO\Type::fromString($type))
		;
	}
}