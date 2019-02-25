<?php


namespace RGA\Test\Application\Additional\Query;

use RGA\Application\Additional\Query\ReadModel\Additional;
use RGA\Domain\Model\Additional\Additional as VO;

trait AdditionalHandlerTestTrait
{
	/**
	 * @param string|integer $id
	 * @return Additional
	 */
	protected function createAdditionalView($id, string $rgaUuid): Additional
	{
		return Additional::fromId($id)
			->setRgaUuid(VO\RgaUuid::fromString($rgaUuid))
		;
	}
}