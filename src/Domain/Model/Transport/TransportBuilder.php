<?php

namespace RGA\Domain\Model\Transport;

use Ramsey\Uuid\UuidInterface;
use RGA\Infrastructure\Model\Translate\Lang\Collector as TranslateCollector;

class TransportBuilder
{
	/**
	 * @param UuidInterface $uuid
	 * @param TranslateCollector $langs
	 * @param boolean $isActive
	 * @param string $courierSymbol
	 * @param TransportAliasCollector $aliases
	 * @return Transport
	 */
	public static function create(
		UuidInterface $uuid,
		TranslateCollector $langs,
		$isActive,
		$courierSymbol,
		TransportAliasCollector $aliases
	)
	{
		$transport = new Transport();
		$transport->setLang($langs);
		$transport->setId($uuid);
		$transport->setIsActive($isActive);
		$transport->setCourierSymbol($courierSymbol);
		$transport->setAliases($aliases);
		
		return $transport;
	}
}