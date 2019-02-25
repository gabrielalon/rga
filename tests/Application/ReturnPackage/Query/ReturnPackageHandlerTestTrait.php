<?php


namespace RGA\Test\Application\ReturnPackage\Query;

use RGA\Application\ReturnPackage\Query\ReadModel\ReturnPackage;
use RGA\Domain\Model\ReturnPackage\ReturnPackage as VO;

trait ReturnPackageHandlerTestTrait
{
	/**
	 * @param integer|string $id
	 * @param string $rgaUuid
	 * @return ReturnPackage
	 */
	protected function createReturnPackageView($id, string $rgaUuid): ReturnPackage
	{
		return ReturnPackage::fromId($id)
			->setRgaUuid(VO\RgaUuid::fromString($rgaUuid))
		;
	}
}