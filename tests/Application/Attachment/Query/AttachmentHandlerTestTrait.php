<?php


namespace RGA\Test\Application\Attachment\Query;

use RGA\Application\Attachment\Query\ReadModel\Attachment;
use RGA\Domain\Model\Attachment\Attachment as VO;

trait AttachmentHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @return Attachment
	 */
	protected function createAttachmentView(string $uuid, string $rgaUuid): Attachment
	{
		return Attachment::fromUuid($uuid)
			->setRgaUuid(VO\RgaUuid::fromString($rgaUuid))
		;
	}
}