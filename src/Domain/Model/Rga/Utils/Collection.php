<?php

namespace RGA\Domain\Model\Rga\Utils;

use RGA\Domain\Model\Rga\Rga\Attachment;

class Collection
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