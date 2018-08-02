<?php

namespace RGA\Domain\Model\Transport;

class TransportAliasCollector
	extends \ArrayIterator
{
	/**
	 * @param TransportAlias $model
	 */
	public function add(TransportAlias $model)
	{
		$this->offsetSet($model->getName(), $model);
	}
}