<?php

namespace RGA\Test\Application;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use RGA\Application\DI\PhpDi\Container;

abstract class HandlerTestCase
	extends PHPUnitTestCase
{
	/** @var \DI\Container */
	private $container;
	
	/**
	 * @param string $key
	 * @return mixed
	 */
	protected function getFromContainer(string $key)
	{
		if (null === $this->container)
		{
			$container = new Container();
			$this->container = $container->initialize();
		}
		
		return $this->container->get($key);
	}
}