<?php

namespace RGA\Test\Mock\Source;

use RGA\Domain\Model\Rga\Rga\Applicant\Applicant;
use RGA\Domain\Model\Source\RgaObjectBuilder;
use RGA\Domain\Model\Source\RgaObjectItemBuilder;
use RGA\Domain\Model\Source\RgaObjectItemCollector;
use RGA\Infrastructure\Source\RgaObject;
use RGA\Infrastructure\Source\Service\ServiceInterface;

class OrderSourceService
	implements ServiceInterface
{
	/** @var int */
	public $orderID = 1;
	
	/** @var int */
	public $customerID = 99;
	
	/**
	 * @return string
	 */
	public function sourceType(): string
	{
		return 'order';
	}
	
	/**
	 * @param string $id
	 * @return RgaObject\RgaObjectInterface|\RGA\Domain\Model\Source\RgaObject
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($id): RgaObject\RgaObjectInterface
	{
		$builder = new RgaObjectBuilder(
			$id,
			$this->sourceType(),
			new Applicant($this->customerID, 'customer'),
			true,
			1535580000 //30.08.2018
		);
		
		// Base address data
		$builder
			->setCity('test')
			->setPostCode('00-000')
			->setStreetName('test')
			->setHouseNo(12)
			->setApartmentNo(1)
			->setCountryCode('pl');
		
		// Personal data
		$builder
			->setFirstName('test')
			->setLastName('test')
			->setEmail('test@test.pl')
			->setTelephone('123456789')
			->setContactPreference('email');
		
		$collector = new RgaObjectItemCollector();
		$collector->add($this->buildObjectItem(2));
		
		$builder->setItems($collector);
		
		return $builder->build();
	}
	
	/**
	 * @param string $itemId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId): RgaObject\RgaObjectItemInterface
	{
		$itemBuilder = new RgaObjectItemBuilder(
			$itemId,
			1000,
			'testowy',
			true
		);
		
		$itemBuilder
			->setFinalDateOfComplaint(1567116000) //30.08.2019
			->setFinalDateOfReturn(1567116000) //30.08.2019
			->setWarranty(12)
            ->setQuantity(10.00);
		
		return $itemBuilder->build();
	}
}