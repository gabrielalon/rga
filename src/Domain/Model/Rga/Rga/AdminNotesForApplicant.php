<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class AdminNotesForApplicant
{
	/** @var string */
	private $notes;
	
	/**
	 * @param string $notes
	 * @return AdminNotesForApplicant
	 */
	public static function fromString(string $notes): AdminNotesForApplicant
	{
		return new AdminNotesForApplicant($notes);
	}
	
	/**
	 * @param string $notes
	 */
	private function __construct(string $notes)
	{
		Assertion::string($notes, 'Invalid AdminNotesForApplicant string: ' . $notes);
		
		$this->notes = $notes;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->notes;
	}
	
	/**
	 * @param AdminNotesForApplicant $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof AdminNotesForApplicant)
		{
			return false;
		}
		
		return $this->notes === $other->notes;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->notes;
	}
}