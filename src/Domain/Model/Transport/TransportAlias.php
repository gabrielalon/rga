<?php

namespace RGA\Domain\Model\Transport;

class TransportAlias
{
	/** @var string */
	protected $name;
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 */
	public function setName(string $name)
	{
		$this->name = $name;
	}
}