<?php

namespace RGA\Infrastructure\Log\Blamable;

interface AdminInterface
{
	/**
	 * @return string
	 */
	public function getFullName(): string;
	
	/**
	 * @return int
	 */
	public function getReferenceID(): int;
}