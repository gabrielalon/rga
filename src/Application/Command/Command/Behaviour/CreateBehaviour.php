<?php

namespace RGA\Application\Command\Command\Behaviour;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject;
use RGA\Domain\ValueObject\Behaviour\Behaviour;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateBehaviour implements CommandInterface
{
	/** @var UuidInterface */
	private $uuid;

	/** @var Behaviour */
	private $behaviour;

	/** @var Lang */
	private $name;

	/**
	 * CreateBehaviour constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param Behaviour $behaviour
	 * @param Lang $name
	 */
	public function __construct(
		UuidInterface $uuid,
		ValueObject\Behaviour\Behaviour $behaviour,
		ValueObject\Lang\Lang $name
	) {
		$this->uuid = $uuid;
		$this->behaviour = $behaviour;
		$this->name = $name;
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface
	{
		return $this->uuid;
	}

	/**
	 * @return Behaviour
	 */
	public function getBehaviour(): Behaviour
	{
		return $this->behaviour;
	}

	/**
	 * @return Lang
	 */
	public function getName(): Lang
	{
		return $this->name;
	}
}