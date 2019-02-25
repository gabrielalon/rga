<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByActiveFilter
	extends \FilterIterator
{
	/** @var bool */
	private $active;
	
	/**
	 * @param bool $active
	 */
	public function setActive(bool $active): void
	{
		$this->active = $active;
	}
	
	/**
	 * @param bool $active
	 * @return bool
	 */
	private function isActive(bool $active): bool
	{
		return $this->active === $active;
	}
	
	/**
	 * @return bool
	 */
	public function accept(): bool
	{
		/** @var Viewable $view */
		$view = $this->getInnerIterator()->current();
		
		try
		{
			$reflection = new \ReflectionClass($view);
			$method = $reflection->getMethod('active');
			
			return $this->isActive($method->invoke($view));
		}
		catch (\Exception $e)
		{
			return false;
		}
	}
}