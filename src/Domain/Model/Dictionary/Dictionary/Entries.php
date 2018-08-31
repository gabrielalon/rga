<?php

namespace RGA\Domain\Model\Dictionary\Dictionary;

use RGA\Infrastructure\Model\Translate\Locales;

final class Entries
	extends Locales
{
	/**
	 * @param array $data
	 * @return Entries
	 */
	public static function fromArray(array $data): Entries
	{
		return new Entries($data);
	}
}