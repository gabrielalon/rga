<?php

namespace RGA\Application\Additional\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class AdditionalCollection
	extends \ArrayIterator
	implements ViewableCollection
{
	/**
	 * @param Additional $attachmentView
	 */
	public function add(Additional $attachmentView): void
	{
		$this->offsetSet($attachmentView->identifier(), $attachmentView);
	}
	
	/**
	 * @param string $uuid
	 * @return Additional
	 */
	public function get(string $uuid): Additional
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
	 * @return Additional[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}