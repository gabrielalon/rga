<?php

namespace RGA\Domain\ValueObject\Base;

final class AdminNotesForApplicant
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $notes
	 */
	public function __construct($notes)
	{
		$this->value = $notes;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}