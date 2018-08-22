<?php

namespace RGA\Infrastructure\Model\Identify;

trait Guided
{
	/** @var string */
	protected $uuid;

	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}

	/**
	 * @param string $uuid
	 */
	public function setUuid($uuid): void
	{
		$this->uuid = $uuid;
	}
}