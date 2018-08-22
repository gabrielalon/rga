<?php

namespace RGA\Domain\Model\Attachment;

class AttachmentCollection
	extends \ArrayIterator
{
	/**
	 * @param Attachment $attachment
	 */
	public function add(Attachment $attachment): void
	{
		$this->append($attachment);
	}
}