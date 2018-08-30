<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Infrastructure\Model\Translate\Locales;

final class Names
	extends Locales
{
	/**
	 * @param array $data
	 * @return Names
	 */
	public static function fromArray(array $data): Names
	{
		return new Names($data);
	}
}