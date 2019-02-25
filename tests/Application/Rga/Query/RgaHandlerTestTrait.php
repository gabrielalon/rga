<?php

namespace RGA\Test\Application\Rga\Query;

use RGA\Application\Rga\Query\ReadModel\Rga;
use RGA\Domain\Model\Rga\Rga as VO;

trait RgaHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @return Rga
	 */
	protected function createRgaView(string $uuid): Rga
	{
		return Rga::fromUuid($uuid)
			->setIndividualNumber(VO\IndividualNumber::fromInteger((int)$uuid))
			->setHash(VO\Hash::fromString(\sha1($uuid)))
			->setPackageNo(VO\PackageNo::fromString($uuid))
			->setPackageSent(VO\PackageSent::fromBoolean(true))
		;
	}
}