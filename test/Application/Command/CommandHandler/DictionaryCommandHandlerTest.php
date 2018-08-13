<?php

namespace RGA\Test\Application\Command\CommandHandler;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RGA\Application\Command\Command\Dictionary\CreateDictionary;
use RGA\Application\Command\Command\Dictionary\DeleteDictionary;
use RGA\Application\Command\Command\Dictionary\UpdateDictionary;
use RGA\Application\Command\CommandHandler\DictionaryCommandHandler;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepositoryInterface;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Test\Infrastructure\Persist\InMemoryDictionaryRepository;

class DictionaryCommandHandlerTest extends TestCase
{
	/**
	 * @var DictionaryRepositoryInterface
	 */
	private $dictionaryRepository;
	/**
	 * @var DictionaryCommandHandler
	 */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateDictionary()
	{
		$lang = new Lang([
			'entry__pl' => 'powód testowy',
		]);

		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$this->handler->handle(new CreateDictionary($guid, true, 'reason', $lang));

		$dictionary = $this->dictionaryRepository->load($guid);
		$this->assertEquals($guid, $dictionary->getUuid());
	}

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canUpdateDictionary()
	{
		$lang = new Lang([
			'entry__pl' => 'powód testowy',
		]);

		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$this->handler->handle(new CreateDictionary($guid, true, 'reason', $lang));

		$langNew = new Lang([
			'entry__pl' => 'nowy powód testowy',
		]);
		$this->handler->handle(new UpdateDictionary($guid, false, $langNew));
		$dictionary = $this->dictionaryRepository->load($guid);

		$plEntry = $dictionary->getLang()->offsetGet('pl')->getEntry();

		$this->assertEquals('nowy powód testowy', $plEntry);
		$this->assertFalse($dictionary->isDeletable());
	}

	/**
	 * @test
	 */
	public function canDeleteDictionary(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$model = new Dictionary(
			$uuid,
			'reason',
			true
		);

		$this->dictionaryRepository->save($model);
		$command = new DeleteDictionary($uuid);

		$this->handler->handle($command);
		$this->expectException(NotFound::class);
		$this->expectExceptionMessage('Entity not found');
		$dictionary = $this->dictionaryRepository->load($uuid);
	}

	/**
	 * @test
	 */
	public function canNotDeleteState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$model = new Dictionary(
			$uuid,
			'reason',
			false
		);

		$this->dictionaryRepository->save($model);
		$command = new DeleteDictionary($uuid);
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('cannot_remove_irremovable_dictionary');
		$this->handler->handle($command);
	}

	public function setUp()
	{
		$this->dictionaryRepository = new InMemoryDictionaryRepository();
		$this->handler = new DictionaryCommandHandler(
			$this->dictionaryRepository
		);
	}
}