<?php

namespace RGA\Application\Additional\Query\Decorator;

use RGA\Application\Additional\Query\ReadModel\Additional;

class AdditionalDecorator
{
	/** @var DescriptionDecoratorRegistry */
	private $registry;
	
	/**
	 * @param DescriptionDecoratorRegistry $registry
	 */
	public function __construct(DescriptionDecoratorRegistry $registry)
	{
		$this->registry = $registry;
	}
	
	/**
	 * @param Additional $additional
	 * @param string $locale
	 * @return string
	 */
	public function describe(Additional $additional, string $locale = 'pl'): string
	{
		return $this->registry->get($additional->serviceType())->extract($additional, $locale);
	}
}