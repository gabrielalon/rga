<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command\Command\Dictionary\CreateDictionary;
use RGA\Application\Command\Command\Dictionary\DeleteDictionary;
use RGA\Application\Command\Command\Dictionary\UpdateDictionary;
use RGA\Application\Command\CommandHandling\AbstractCommandHandler;
use RGA\Domain\Model\Dictionary\DictionaryBuilder;
use RGA\Domain\Model\Dictionary\DictionaryLangBuilder;
use RGA\Domain\Validation\AssertionConcern;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Model\Translate\Lang\Collector;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepositoryInterface;

class DictionaryCommandHandler extends AbstractCommandHandler
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
	 * @param CreateDictionary $command
	 */
	public function handleCreateDictionary(CreateDictionary $command): void
	{
		$builder = DictionaryBuilder::create(
			$command->getUuid(),
			$command->getType(),
			$command->isDelete()
		);
		$builder->setLang($command->getEntries());
		$model = $builder->extract();

		$this->repository->save($model);
	}

	/**
	 * @param UpdateDictionary $command
	 */
	public function handleUpdateDictionary(UpdateDictionary $command): void
	{
		$dictionary = $this->repository->find($command->getUuid());
		$collector = $this->getCollector($command->getEntries());
		$dictionary->setIsDeletable($command->isDelete());
		$dictionary->setLang($collector);

		$this->repository->save($dictionary);
	}

	/**
	 * @param Lang $lang
	 * @return Collector
	 */
	private function getCollector(Lang $lang): Collector
	{
		$collector = new Collector();
		foreach ($lang->getSupportedLanguageCodes() as $languageCode)
		{
			$builder = new DictionaryLangBuilder($languageCode);
			$name = $lang->getForLang('entry', $languageCode);

			$collector->add($builder->create($name));
		}

		return $collector;
	}

	/**
	 * @param DeleteDictionary $command
	 */
	public function handleDeleteDictionary(DeleteDictionary $command): void
	{
		$dictionary = $this->repository->find($command->getUuid());
		AssertionConcern::assertArgumentIsDeletableDictionary($dictionary, 'cannot_remove_irremovable_dictionary');

		$this->repository->delete($command->getUuid());
	}
}