<?php

namespace RGA\Infrastructure\Query\EventStream;

use RGA\Application\SegregationSourcing\Query;
use RGA\Domain\Model\SegregationSourcing\StorageEvent as VO;

trait StorageEventQueryTrait
{
	/**
	 * @param Query\ReadModel\StorageEventCollection $collection
	 * @param \stdClass $row
	 */
	public function populateCollectionWithData(Query\ReadModel\StorageEventCollection $collection, \stdClass $row): void
	{
		$collection->add(Query\ReadModel\StorageEvent::fromVersion((int)$row->version)
			->setEventName(VO\EventName::fromString($row->message))
			->setEventId(VO\EventId::fromString($row->message_identifier))
			->setPayload(VO\Payload::fromString($row->payload))
			->setMetadata(VO\Metadata::fromString($row->metadata))
			->setCreatedAt(VO\CreatedAt::fromString($row->created_at))
			->setResponsible(VO\Responsible::fromString($row->responsible)))
		;
	}
}