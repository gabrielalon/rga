<?php

namespace RGA\Infrastructure\Source\Service;

final class Baser64 implements BaserInterface
{
	/**
	 * @param string $data
	 * @return string
	 */
	public function decode(?string $data = null): string
	{
		if (true === $this->validBase64($data))
		{
			$decoded = $this->base64Decode($data);
			
			return $decoded;
		}
		
		return (string) $data;
	}
	
	/**
	 * @param string $data
	 * @return string
	 */
	public function encode(?string $data = null): string
	{
		if (false === $this->validBase64($data))
		{
			return base64_encode((string)$data);
		}
		
		return (string) $data;
	}
	
	/**
	 * @param string $text
	 * @return bool|string
	 */
	private function base64Decode(string $text)
	{
		$decoded = base64_decode($text, true);
		
		return $decoded;
	}
	
	/**
	 * @param string|null $text
	 * @return bool
	 */
	private function validBase64(?string $text = null): bool
	{
		if (null === $text)
		{
			return false;
		}
		
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