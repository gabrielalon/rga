<?php


namespace RGA\Test\Application\Transport\Query;

use RGA\Application\Transport\Query\ReadModel\Transport;

trait TransportHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @param string $domain
	 * @return Transport
	 */
	protected function createTransportView(string $uuid, string $domain): Transport
	{
		return Transport::fromUuid($uuid)
			->addDomain($domain)
		;
	}
}