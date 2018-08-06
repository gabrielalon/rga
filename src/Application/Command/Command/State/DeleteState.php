<?php

namespace RGA\Application\Command\Command\State;

use RGA\Infrastructure\Command\Command\CommandInterface;

class DeleteState implements CommandInterface
{
	/** @var string */
	private $id;

	/**
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}
}