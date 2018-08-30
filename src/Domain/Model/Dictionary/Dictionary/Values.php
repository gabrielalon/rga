<?php

namespace RGA\Domain\Model\Dictionary\Dictionary;

use RGA\Infrastructure\Model\Translate\Locales;

final class Values
	extends Locales
{
	/**
	 * @param array $data
	 * @return Values
	 */
	public static function fromArray(array $data): Values
	{
		return new Values($data);
	}
}