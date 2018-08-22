<?php

namespace RGA\Test\Mock\Application\Source\Service;

use RGA\Domain\Model\Source;
use RGA\Domain\ValueObject\Applicant\Applicant;
use RGA\Infrastructure\Source\RgaObject;
use RGA\Infrastructure\Source\Service;

class OrderService
	implements Service\ServiceInterface
{
	/**
	 * @return string
	 */
	public function sourceType(): string
	{
		return 'order';
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
			new Applicant(1, 'customer'),
			true,
			1534888800, // 22.08.2018
			true
		);
		
		// Base address data
		$builder
			->setCity('test')
			->setPostCode('00-000')
			->setStreetName('test')
			->setHouseNo('0')
			->setApartmentNo('0')
			->setCountryCode('pl');
		
		// Personal data
		$builder
			->setFirstName('test')
			->setLastName('test')
			->setEmail('test@test.com')
			->setTelephone('000000000')
			->setContactPreference('email');
		
		$builderItem = new Source\RgaObjectItemBuilder(
			10,
			99,
			'test produkt',
			$this->sourceType(),
			$id,
			12
		);
		
		$builder->setItems(new Source\RgaObjectItemCollector([
			$builderItem->build()
		]));
		
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