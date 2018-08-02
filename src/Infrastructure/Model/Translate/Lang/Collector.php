<?php

namespace RGA\Infrastructure\Model\Translate\Lang;

use RGA\Infrastructure\Model\Translate\TranslateInterface;

class Collector
	extends \ArrayIterator
{
	/**
	 * @param TranslateInterface $model
	 */
	public function add(TranslateInterface $model)
	{
		$this->offsetSet($model->getLanguageCode(), $model);
	}
}