<?php

namespace RGA\Application\Service;

interface DataProviderInterface
{
	/**
	 * @return string
	 */
	public function uuid(): string;
	
	/**
	 * @throws \Exception
	 */
	public function verify(): void;
}