<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command;
use RGA\Domain\Model\Dictionary;
use RGA\Domain\Validation;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepositoryInterface;

class DictionaryCommandHandler
	extends Command\CommandHandling\AbstractCommandHandler
{
	/** @var DictionaryRepositoryInterface */
	private $repository;

	/**
	 * @param DictionaryRepositoryInterface $repository
	 */
	public function __construct(DictionaryRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param Command\Command\Dictionary\CreateDictionary $command
	 */
	public function handleCreateDictionary(Command\Command\Dictionary\CreateDictionary $command): void
	{
		$builder = Dictionary\Builder\Dictionary::init($command->getUuid());
		$builder->setType($command->getType());
		$builder->setIsDeletable($command->isDelete());
		$builder->setEntries($command->getEntries());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param Command\Command\Dictionary\UpdateDictionary $command
	 */
	public function handleUpdateDictionary(Command\Command\Dictionary\UpdateDictionary $command): void
	{
		$dictionary = $this->repository->find($command->getUuid());
		
		$builder = new Dictionary\Builder\Dictionary($dictionary);
		$builder->setIsDeletable($command->isDelete());
		$builder->setEntries($command->getEntries());

		$this->save($builder->build());
	}
	
	/**
	 * @param Dictionary\Dictionary $model
	 */
	private function save(Dictionary\Dictionary $model)
	{
		$this->validate(new Validation\Dictionary\DictionaryValidationRules(), $model);
		
		$this->repository->save($model);
	}
	
	/**
	 * @param Command\Command\Dictionary\DeleteDictionary $command
	 */
	public function handleDeleteDictionary(Command\Command\Dictionary\DeleteDictionary $command): void
	{
		$dictionary = $this->repository->find($command->getUuid());
		Validation\AssertionConcern::assertArgumentIsDeletableDictionary($dictionary, 'cannot_remove_irremovable_dictionary');

		$this->repository->delete($command->getUuid());
	}
}