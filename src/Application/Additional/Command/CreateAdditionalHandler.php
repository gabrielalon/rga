<?php

namespace RGA\Application\Additional\Command;

use RGA\Domain\Model\Additional\Additional;
use RGA\Infrastructure\Persist\Additional\AdditionalRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class CreateAdditionalHandler
	implements CommandHandlerInterface
{
	/** @var AdditionalRepository */
	private $repository;
	
	/**
	 * @param AdditionalRepository $repository
	 */
	public function __construct(AdditionalRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|CreateAdditional $message
	 */
	public function run(MessageInterface $message): void
	{
		$attachment = Additional::createNewAdditional(
			Additional\RgaUuid::fromString($message->getRgaUuid()),
			Additional\ServiceType::fromString($message->getServiceType()),
			Additional\ServiceData::fromArray($message->getServiceData())
		);
		
		$this->repository->save($attachment);
	}
}