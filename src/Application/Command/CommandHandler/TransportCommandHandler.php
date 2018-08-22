<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command;
use RGA\Domain\Model\Transport;
use RGA\Domain\Validation;
use RGA\Infrastructure\Persist\Transport\TransportRepositoryInterface;

class TransportCommandHandler
	extends Command\CommandHandling\AbstractCommandHandler
{
	/** @var TransportRepositoryInterface */
	private $repository;
	
	/**
	 * @param TransportRepositoryInterface $repository
	 */
	public function __construct(TransportRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param Command\Command\Transport\CreateTransport $command
	 */
	public function handleCreateTransport(Command\Command\Transport\CreateTransport $command): void
	{
		$builder = Transport\Builder\Transport::init($command->getUuid());
		$builder->setIsActive($command->isActive());
		$builder->setCourierSymbol($command->getCourierSymbol());
		$builder->setNames($command->getNames());
		$builder->setAliases($command->getAliases());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param Command\Command\Transport\UpdateTransport $command
	 */
	public function handleUpdateTransport(Command\Command\Transport\UpdateTransport $command): void
	{
		$model = $this->repository->find($command->getUuid());
		
		$builder = new Transport\Builder\Transport($model);
		$builder->setIsActive($command->isActive());
		$builder->setCourierSymbol($command->getCourierSymbol());
		$builder->setNames($command->getNames());
		$builder->setAliases($command->getAliases());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param Transport\Transport $model
	 */
	public function save(Transport\Transport $model): void
	{
		$this->validate(new Validation\Transport\TransportValidationRules(), $model);
		
		$this->repository->save($model);
	}
	
	/**
	 * @param Command\Command\Transport\DeleteTransport $command
	 */
	public function handleDeleteTransport(Command\Command\Transport\DeleteTransport $command): void
	{
		$this->repository->delete($command->getUuid());
	}
}