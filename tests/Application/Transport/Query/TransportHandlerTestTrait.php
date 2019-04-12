<?php


namespace RGA\Test\Application\Transport\Query;

use RGA\Application\Transport\Query\ReadModel\Transport;
use RGA\Domain\Model\Transport\Transport\Active;

trait TransportHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @param string $domain
	 * @param bool $active
	 * @return Transport
	 */
	protected function createTransportView(string $uuid, string $domain, bool $active = true): Transport
	{
		return Transport::fromUuid($uuid)
			->setActive(Active::fromBoolean($active))
			->addDomain($domain)
		;
	}
}