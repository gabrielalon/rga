<?php

namespace RGA\Infrastructure\Source\Service;

use RGA\Domain\Model\Rga\Rga\Applicant\Applicant;
use RGA\Domain\Model\Source\RgaObjectBuilder;
use RGA\Domain\Model\Source\RgaObjectItemBuilder;
use RGA\Domain\Model\Source\RgaObjectItemCollector;
use RGA\Infrastructure\Source\RgaObject;

class StandardService
	implements ServiceInterface
{
	/** @var BaserInterface */
	private $baser;
	
	/**
	 * @param BaserInterface $baser
	 */
	public function __construct(BaserInterface $baser)
	{
		$this->baser = $baser;
	}
	
	/**
	 * @return string
	 */
	public function sourceType(): string
	{
		return 'unknown';
	}
	
	/**
	 * @param string $encodeId
	 * @return RgaObject\RgaObjectInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($encodeId): RgaObject\RgaObjectInterface
	{
		$id = $this->baser->decode($encodeId);
		$builder = new RgaObjectBuilder(
			$id,
			$this->sourceType(),
			new Applicant(0, 'guest'),
			true,
			time(),
			true
		);
		
		$items = new RgaObjectItemCollector();
		$items->add($this->buildObjectItem(0));
		
		$builder->setItems($items);
		
		return $builder->build();
	}
	
	/**
	 * @param string $itemId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId): RgaObject\RgaObjectItemInterface
	{
		$rmaObjectItemBuilder = new RgaObjectItemBuilder(
			$itemId,
			0,
			''
		);
		
		return $rmaObjectItemBuilder->build();
	}
}