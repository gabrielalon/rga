<?php

namespace RGA\Application\Attachment\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class AttachmentCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param Attachment $attachmentView
	 */
	public function add(Attachment $attachmentView): void
	{
		$this->offsetSet($attachmentView->identifier(), $attachmentView);
	}
	
	/**
	 * @param string $uuid
	 * @return Attachment
	 */
	public function get(string $uuid): Attachment
	{
		return $this->offsetGet($uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return bool
	 */
	public function has(string $uuid): bool
	{
		return $this->offsetExists($uuid);
	}
	
	/**
	 * @return Attachment[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}