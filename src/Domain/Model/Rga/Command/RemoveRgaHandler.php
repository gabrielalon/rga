<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Infrastructure\Persist\Rga\RgaRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class RemoveRgaHandler
	implements CommandHandlerInterface
{
	/** @var RgaRepository */
	private $repository;
	
	/**
	 * @param RgaRepository $repository
	 */
	public function __construct(RgaRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|RemoveRga $message
	 */
	public function run(MessageInterface $message): void
	{
		$rga = $this->repository->find($message->getUuid());
		
		$rga->removeRga();
		
		$this->repository->save($rga);
	}
}