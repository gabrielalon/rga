<?php

namespace RGA\Infrastructure\Model\Translate;

class LocaleCollector
	extends \ArrayIterator
{
	/**
	 * @param Translatable $model
	 */
	public function add(Translatable $model): void
	{
		$this->offsetSet($model->getLocale(), $model);
	}
}