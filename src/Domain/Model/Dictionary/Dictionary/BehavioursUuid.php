<?php

namespace RGA\Domain\Model\Dictionary\Dictionary;

use RGA\Application\Assert\Assertion;
use RGA\Domain\Model\Dictionary\Utils;

final class BehavioursUuid
{
	/** @var array */
	private $domains;
	
	/**
	 * @param array $domains
	 * @return BehavioursUuid
	 */
	public static function fromArray(array $domains): BehavioursUuid
	{
		return new BehavioursUuid($domains);
	}
	
	/**
	 * @param array $domains
	 */
	protected function __construct(array $domains)
	{
		Assertion::isArray($domains, 'Invalid BehavioursUuid array');
		
		$collection = new Utils\Collection();
		
		foreach ($domains as $domain)
		{
			$collection->add(BehaviourUuid::fromString($domain));
		}
		
		$this->domains = $collection;
	}
	
	/**
	 * @param string $domain
	 */
	public function addDomain(string $domain): void
	{
		$this->domains->add(BehaviourUuid::fromString($domain));
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
		
		return $this->domains->equals($other->domains);
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		$domains = [];
		
		/** @var BehaviourUuid $domain */
		foreach ($this->all() as $domain)
		{
			$domains[] = $domain->toString();
		}
		
		return \serialize($domains);
	}
	
	/**
	 * @return BehaviourUuid[]
	 */
	public function all(): array
	{
		return $this->domains->getArrayCopy();
	}
}