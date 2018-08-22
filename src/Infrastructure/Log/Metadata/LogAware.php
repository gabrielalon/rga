<?php

namespace RGA\Infrastructure\Log\Metadata;


trait LogAware
{
	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return (array)\get_object_vars($this);
	}
}