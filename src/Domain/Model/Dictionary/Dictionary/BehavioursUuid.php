<?php

namespace RGA\Domain\Model\Dictionary\Dictionary;

use RGA\Application\Assert\Assertion;
use RGA\Application\Dictionary\Utils;

final class BehavioursUuid
{
	/** @var array */
	private $uuids;
	
	/**
	 * @param array $uuids
	 * @return BehavioursUuid
	 */
	public static function fromArray(array $uuids): BehavioursUuid
	{
		return new BehavioursUuid($uuids);
	}
	
	/**
	 * @param array $uuids
	 */
	protected function __construct(array $uuids)
	{
		Assertion::isArray($uuids, 'Invalid BehavioursUuid array');
		
		$collection = new Utils\Collection();
		
		foreach ($uuids as $uuid)
		{
			$collection->add(BehaviourUuid::fromString($uuid));
		}
		
		$this->uuids = $collection;
	}
	
	/**
	 * @param string $uuid
	 */
	public function addUuid(string $uuid): void
	{
		$this->uuids->add(BehaviourUuid::fromString($uuid));
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param BehavioursUuid $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof BehavioursUuid)
		{
			return false;
		}
		
		return $this->uuids->equals($other->uuids);
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return \serialize($this->raw());
	}
	
	/**
	 * @return array
	 */
	public function raw(): array
	{
		$uuids = [];
		
		/** @var BehaviourUuid $uuid */
		foreach ($this->all() as $uuid)
		{
			$uuids[] = $uuid->toString();
		}
		
		return $uuids;
	}
	
	/**
	 * @return BehaviourUuid[]
	 */
	public function all(): array
	{
		return $this->uuids->getArrayCopy();
	}
}