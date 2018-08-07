<?php

namespace RGA\Application\Source\Service;

use RGA\Domain\Model\Source;
use RGA\Domain\ValueObject\Applicant\Applicant;
use RGA\Infrastructure\Source\RgaObject;
use RGA\Infrastructure\Source\Service;

class StandardService
	implements Service\ServiceInterface
{
	/**
	 * @return string
	 */
	public function sourceType()
	{
		return 'unknown';
	}
	
	/**
	 * @param string $id
	 * @return RgaObject\RgaObjectInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($id)
	{
		$builder = new Source\RgaObjectBuilder(
			$id,
			$this->sourceType(),
			new Applicant(0, 'guest'),
			true,
			time(),
			true
		);
		
		return $builder->build();
	}
	
	/**
	 * @param string $itemId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId)
	{
		$rmaObjectItemBuilder = new Source\RgaObjectItemBuilder(
			$itemId,
			0,
			'',
			$this->sourceType(),
			0,
			null
		);
		
		return $rmaObjectItemBuilder->build();
	}
}