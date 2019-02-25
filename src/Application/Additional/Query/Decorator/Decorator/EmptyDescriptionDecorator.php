<?php

namespace RGA\Application\Additional\Query\Decorator\Decorator;

use RGA\Application\Additional\Query\Decorator\DescriptionDecoratorInterface;
use RGA\Application\Additional\Query\ReadModel\Additional;

class EmptyDescriptionDecorator
	implements DescriptionDecoratorInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'empty';
	}
	
	/**
	 * @param Additional $additional
	 * @param string $locale
	 * @return string
	 */
	public function extract(Additional $additional, string $locale): string
	{
		return '';
	}
}