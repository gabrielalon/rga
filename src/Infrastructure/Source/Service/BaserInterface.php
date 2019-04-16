<?php

namespace RGA\Infrastructure\Source\Service;

interface BaserInterface
{
	/**
	 * @param string $data
	 * @return string
	 */
	public function decode(string $data): string;
	
	/**
	 * @param string $data
	 * @return string
	 */
	public function encode(string $data): string;
}