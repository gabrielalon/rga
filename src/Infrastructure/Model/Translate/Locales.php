<?php

namespace RGA\Infrastructure\Model\Translate;

use RGA\Application\Assert\Assertion;
use RGA\Infrastructure\Model\Translate\Translate;
use RGA\Infrastructure\Model\Translate\Utils;

abstract class Locales
{
	/** @var array */
	private $data;
	
	/**
	 * @param array $data
	 * @return self
	 */
	abstract public static function fromArray(array $data);
	
	/**
	 * @param array $data
	 */
	protected function __construct(array $data)
	{
		Assertion::isArray($data, 'Invalid Data array');
		Assertion::notEmpty($data, 'Data array is empty');
		
		$collection = new Utils\Collection();
		
		foreach ($data as $locale => $value)
		{
			$collection->add(Translate\Locale::fromString($locale), Translate\Value::fromString($value));
		}
		
		$this->data = $collection;
	}
	
	/**
	 * @param string $locale
	 * @return Translate\Value
	 */
	public function getLocale(string $locale): Translate\Value
	{
		$value = Translate\Value::fromString('');
		
		if (true === $this->data->offsetExists($locale))
		{
			/** @var Translate\Value $value */
			$value = $this->data->offsetGet($locale);
		}
		
		return $value;
	}
	
	/**
	 * @return array
	 */
	public function getLocales(): array
	{
		return $this->data->getArrayCopy();
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param Locales $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Locales)
		{
			return false;
		}
		
		return $this->data->equals($other->data);
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		$data = [];
		
		/**
		 * @var string $locale
		 * @var Translate\Value $value
		 */
		foreach ($this->data->getArrayCopy() as $locale => $value)
		{
			$data[$locale] = $value->toString();
		}
		
		return \json_encode($data);
	}
}