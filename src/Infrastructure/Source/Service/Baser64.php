<?php

namespace RGA\Infrastructure\Source\Service;

final class Baser64 implements BaserInterface
{
	/**
	 * @param string $data
	 * @return string
	 */
	public function decode(string $data): string
	{
		if (true === $this->validBase64($data))
		{
			$decoded = $this->base64Decode($data);
			
			return $decoded;
		}
		
		return $data;
	}
	
	/**
	 * @param string $data
	 * @return string
	 */
	public function encode(string $data): string
	{
		if (false === $this->validBase64($data))
		{
			return base64_encode($data);
		}
		
		return $data;
	}
	
	/**
	 * @param string $text
	 * @return bool|string
	 */
	private function base64Decode($text)
	{
		$decoded = base64_decode($text, true);
		
		return $decoded;
	}
	
	/**
	 * @param string $text
	 * @return bool
	 */
	private function validBase64($text): bool
	{
		if (true === is_numeric($text))
		{
			return false;
		}
		
		// Check if there is no invalid character in string
		if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $text))
		{
			return false;
		}
		
		// Decode the string in strict mode and send the response
		if (!base64_decode($text, true))
		{
			return false;
		}
		
		// Encode and compare it to original one
		$decoded = $this->base64Decode($text);
		if (base64_encode($decoded) != $text)
		{
			return false;
		}
		
		return true;
	}
}