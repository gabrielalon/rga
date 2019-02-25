<?php

namespace RGA\Infrastructure\Query\Dictionary;

use RGA\Application\Dictionary\Query;
use RGA\Domain\Model\Dictionary\Dictionary as VO;

trait DictionaryQueryTrait
{
	/**
	 * @param Query\ReadModel\DictionaryCollection $collection
	 * @param \stdClass $row
	 */
	public function populateCollectionWithData(Query\ReadModel\DictionaryCollection $collection, \stdClass $row): void
	{
		if (true === $collection->has($row->uuid))
		{
			$readModel = $collection->get($row->uuid)
				->addEntry($row->locale, $row->entry);
		}
		else
		{
			$readModel = (new Query\ReadModel\Dictionary($row->uuid))
				->setType(VO\Type::fromString((string)$row->type))
				->addEntry($row->locale, $row->entry)
				->setBehaviours(VO\BehavioursUuid::fromArray(\explode('|', $row->behaviours_uuid)))
			;
		}
		
		$collection->add($readModel);
	}
}