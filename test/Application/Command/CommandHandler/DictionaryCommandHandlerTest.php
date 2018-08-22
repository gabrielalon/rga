<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command;
use RGA\Application\Enum\Dictionary\DictionaryType;
use RGA\Domain\Model\Dictionary;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepositoryInterface;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Test\Infrastructure\Persist\InMemoryDictionaryRepository;

class DictionaryCommandHandlerTest extends TestCase
{
	/** @var DictionaryRepositoryInterface */
	private $repository;
	
	/** @var Command\CommandHandler\DictionaryCommandHandler */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateReasonDictionary()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale(['entry__pl' => 'testowy powód', 'entry__en' => 'test reason']);
		
		//when
		$command = new Command\Command\Dictionary\CreateDictionary($guid, true, DictionaryType::REASON_TYPE, $dataLocale->getAll('entry'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(true, $behaviour->isDeletable());
		$this->assertEquals(DictionaryType::REASON_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('testowy powód', $behaviour->getLocale('pl')->getEntry());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('test reason', $behaviour->getLocale('en')->getEntry());
		
		return $behaviour;
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateContactPreferenceDictionary()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale(['entry__pl' => 'testowa forma kontaktu', 'entry__en' => 'test contact reason']);
		
		//when
		$command = new Command\Command\Dictionary\CreateDictionary($guid, true, DictionaryType::CONTACT_PREFERENCE_TYPE, $dataLocale->getAll('entry'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(true, $behaviour->isDeletable());
		$this->assertEquals(DictionaryType::CONTACT_PREFERENCE_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('testowa forma kontaktu', $behaviour->getLocale('pl')->getEntry());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('test contact reason', $behaviour->getLocale('en')->getEntry());
		
		return $behaviour;
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateExpectationDictionary()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale(['entry__pl' => 'testowe oczekiwania', 'entry__en' => 'test expectation']);
		
		//when
		$command = new Command\Command\Dictionary\CreateDictionary($guid, true, DictionaryType::EXPECTATION_TYPE, $dataLocale->getAll('entry'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(true, $behaviour->isDeletable());
		$this->assertEquals(DictionaryType::EXPECTATION_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('testowe oczekiwania', $behaviour->getLocale('pl')->getEntry());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('test expectation', $behaviour->getLocale('en')->getEntry());
		
		return $behaviour;
	}
	
	/**
	 * @test
	 * @depends canCreateReasonDictionary
	 * @throws \Exception
	 */
	public function canUpdateDictionary()
	{
		//given
		/** @var Dictionary\Dictionary $dictionary */
		$dictionary = \func_get_arg(0);
		$this->repository->save($dictionary);
		
		$dataLocale = new DataLocale(['entry__pl' => 'nowy testowy powód', 'entry__en' => 'new test reason']);
		
		//when
		$guid = $dictionary->getUuid();
		$command = new Command\Command\Dictionary\UpdateDictionary($guid,false, $dataLocale->getAll('entry'));
		$this->handler->handle($command);
		
		//then
		$dictionary = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$dictionary->getUuid());
		$this->assertEquals(false, $dictionary->isDeletable());
		$this->assertEquals(DictionaryType::REASON_TYPE, $dictionary->getType());
		$this->assertEquals(2, $dictionary->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $dictionary->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $dictionary->getLocale('pl'));
		$this->assertEquals('nowy testowy powód', $dictionary->getLocale('pl')->getEntry());
		
		$this->assertArrayHasKey('en', $dictionary->getLocales());
		$this->assertInstanceOf(Dictionary\DictionaryLocale::class, $dictionary->getLocale('en'));
		$this->assertEquals('new test reason', $dictionary->getLocale('en')->getEntry());
	}

	/**
	 * @test
	 */
	public function canDeleteDictionary(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		
		$builder = Dictionary\Builder\Dictionary::init($uuid);
		$builder->setIsDeletable(true);
		$this->repository->save($builder->build());
		
		$command = new Command\Command\Dictionary\DeleteDictionary($uuid);
		$this->handler->handle($command);
		
		$this->expectException(NotFound::class);
		$this->expectExceptionMessage('Entity not found');
		
		$this->repository->find($uuid);
	}

	/**
	 * @test
	 */
	public function canNotDeleteDictionary(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		
		$builder = Dictionary\Builder\Dictionary::init($uuid);
		$builder->setIsDeletable(false);
		$this->repository->save($builder->build());
		
		$command = new Command\Command\Dictionary\DeleteDictionary($uuid);
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('cannot_remove_irremovable_dictionary');
		$this->handler->handle($command);
	}

	public function setUp()
	{
		$this->repository = new InMemoryDictionaryRepository();
		$this->handler = new Command\CommandHandler\DictionaryCommandHandler($this->repository);
	}
}