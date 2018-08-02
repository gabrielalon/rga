<?php

namespace RGA\Application\Command\Command\Behaviour;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject;

class CreateBehaviour
{
	/** @var UuidInterface */
	private $uuid;
	
	/** @var ValueObject\Behaviour\Behaviour */
	private $behaviour;
	
	/** @var ValueObject\Lang\Lang */
	private $name;
	
	/**
	 * @param UuidInterface $uuid
	 * @param ValueObject\Behaviour\Behaviour $behaviour
	 * @param ValueObject\Lang\Lang $name
	 */
	public function __construct(
		UuidInterface $uuid,
		ValueObject\Behaviour\Behaviour $behaviour,
		ValueObject\Lang\Lang $name)
	{
		$this->uuid = $uuid;
		$this->behaviour = $behaviour;
		$this->name = $name;
	}
	
	/**
	 * @return UuidInterface
	 */
	public function getUuid()
	{
		return $this->uuid;
	}
	
	/**
	 * @return ValueObject\Behaviour\Behaviour
	 */
	public function getBehaviour()
	{
		return $this->behaviour;
	}
	
	/**
	 * @return ValueObject\Lang\Lang
	 */
	public function getName()
	{
		return $this->name;
	}
}