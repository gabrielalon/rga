<?php

namespace RGA\Infrastructure\Source\Service;

interface BaserInterface
{
	/**
	 * @param string|null $data
	 * @return string
	 */
	public function decode(?string $data = null): string;
	
	/**
	 * @param string|null $data
	 * @return string
	 */
	public function encode(?string $data = null): string;
}