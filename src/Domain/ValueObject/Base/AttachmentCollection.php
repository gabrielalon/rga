<?php

namespace RGA\Domain\ValueObject\Base;

final class AttachmentCollection
	extends \ArrayIterator
{
	/**
	 * @param Attachment $attachment
	 */
	public function add(Attachment $attachment): void
	{
		$this->offsetSet($attachment->getFileName(), $attachment);
	}
}