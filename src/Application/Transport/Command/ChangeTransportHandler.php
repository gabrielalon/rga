<?php

namespace RGA\Application\Transport\Command;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\Persist\Transport\TransportRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeTransportHandler
	implements CommandHandlerInterface
{
	/** @var TransportRepository */
	private $repository;
	
	/**
	 * @param TransportRepository $repository
	 */
	public function __construct(TransportRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|ChangeTransport $message
	 */
	public function run(MessageInterface $message): void
	{
		$transport = $this->repository->find($message->getIdentifier());
		
		$transport->changeExistingTransport(
			Transport\Active::fromBoolean($message->isActive()),
			Transport\ShipmentId::fromInteger($message->getShipmentId()),
			Transport\Domains::fromArray($message->getDomains()),
			Transport\Names::fromArray($message->getNames())
		);
		
		$this->repository->save($transport);
	}
}