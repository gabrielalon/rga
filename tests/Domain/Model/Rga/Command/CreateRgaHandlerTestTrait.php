<?php

namespace RGA\Test\Domain\Model\Rga\Command;

use RGA\Domain\Model\Rga\Command\CreateRga;
use RGA\Domain\Model\Rga\Integration\Warranty\Config;
use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Integration\Warranty\Calculator;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Test\Mock\Source\OrderSourceService;

trait CreateRgaHandlerTestTrait
{
	/** @var ValueObject\BehaviourUuid */
	private $behaviourUuid;
	
	/** @var ValueObject\StateUuid */
	private $stateUuid;
	
	/** @var ValueObject\TransportUuid */
	private $transportUuid;
	
	/** @var OrderSourceService */
	private $sourceService;
	
	/** @var Calculator */
	private $warrantyCalculator;
	
	/** @var ValueObject\Applicant\Bank */
	private $bank;
	
	public function setUp()
	{
		$this->stateUuid = ValueObject\StateUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->behaviourUuid = ValueObject\BehaviourUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		$this->transportUuid = ValueObject\TransportUuid::fromString(\Ramsey\Uuid\Uuid::uuid4()->toString());
		
		$this->sourceService = new OrderSourceService();
		$this->warrantyCalculator = new Calculator(new Config());
		
		$this->bank = (new ValueObject\Applicant\Bank('ing', '00 0000 0000 0000 0000'));
	}
	
	/**
	 * @param string $uuid
	 * @param RgaObject $sourceObject
	 * @param RgaObjectItem $sourceObjectItem
	 * @return CreateRga
	 */
	protected function getCreateCommand($uuid, RgaObject $sourceObject, RgaObjectItem $sourceObjectItem): CreateRga
	{
		return new CreateRga(
			$uuid,
			new ValueObject\Reference\References($this->stateUuid->toString(), $this->behaviourUuid->toString(), 'return', $this->transportUuid->toString()),
			[new ValueObject\Given\Item($sourceObjectItem->getId(), $sourceObject->getId(), $sourceObjectItem->getName(), 'reason', 'expectation', 'incident')],
			$sourceObject->getApplicant(),
			$sourceObject->getAddress(),
			$sourceObject->getContact(),
			$this->bank,
			$sourceObject
		);
	}
}