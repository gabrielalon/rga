<?php

namespace RGA\Infrastructure\Query\Attachment;

use RGA\Application\Attachment\Query;
use RGA\Domain\Model\Attachment\Attachment as VO;

trait AttachmentQueryTrait
{
	/**
	 * @param Query\ReadModel\AttachmentCollection $collection
	 * @param \stdClass $row
	 */
	public function populateCollectionWithData(Query\ReadModel\AttachmentCollection $collection, \stdClass $row): void
	{
		$collection->add(Query\ReadModel\Attachment::fromUuid($row->uuid)
			->setRgaUuid(VO\RgaUuid::fromString((string)$row->rga_uuid))
			->setFileType(VO\FileType::fromString((string)$row->file_type))
			->setFileName(VO\FileName::fromString((string)$row->file_name))
			->setOriginalFileName(VO\OriginalFileName::fromString((string)$row->original_file_name))
		);
	}
}