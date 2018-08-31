<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Application\Assert\Assertion;
use RGA\Domain\Model\Transport\Utils;

final class Domains
{
	/** @var array */
	private $domains;
	
	/**
	 * @param array $domains
	 * @return Domains
	 */
	public static function fromArray(array $domains): Domains
	{
		return new Domains($domains);
	}
	
	/**
	 * @param array $domains
	 */
	protected function __construct(array $domains)
	{
		Assertion::isArray($domains, 'Invalid Domains array');
		Assertion::notEmpty($domains, 'Domains array is empty');
		
		$collection = new Utils\Collection();
		
		foreach ($domains as $domain)
		{
			$collection->add(Domain::fromString($domain));
		}
		
		$this->domains = $collection;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param Domains $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Domains)
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
		
		/** @var Domain $domain */
		foreach ($this->domains->getArrayCopy() as $domain)
		{
			$domains[] = $domain->toString();
		}
		
		return \serialize($domains);
	}
}