<?php

namespace RGA\Application\Rga\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class RgaCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param Rga $rgaView
	 */
	public function add(Rga $rgaView): void
	{
		$this->offsetSet($rgaView->identifier(), $rgaView);
	}
	
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	public function get(string $uuid): Rga
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
	 * @return Rga[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}