<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command;
use RGA\Domain\Model\State;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Persist;
use RGA\Test\Infrastructure\Persist\InMemoryStateRepository;

class StateCommandHandlerTest extends TestCase
{
	/** @var Persist\State\StateRepositoryInterface */
	private $repository;
	
	/** @var Command\CommandHandler\StateCommandHandler */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateState()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale([
			'name__pl' => 'Nowy status', 'name__en' => 'New state',
			'email_subject__pl' => 'Temat maila', 'email_subject__en' => 'Email subject',
			'email_body__pl' => 'Treść maila', 'email_body__en' => 'Email body'
		]);
		
		//when
		$command = new Command\Command\State\CreateState(
			$guid,
			$dataLocale->getAll('name'),
			$dataLocale->getAll('email_subject'),
			$dataLocale->getAll('email_body'),
			true,
			true,
			true,
			true,
			true,
			true,
			'#800000'
		);
		$this->handler->handle($command);
		
		//then
		$state = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$state->getUuid());
		$this->assertEquals(true, $state->isEditable());
		$this->assertEquals(true, $state->isDeletable());
		$this->assertEquals(true, $state->isRejectable());
		$this->assertEquals(true, $state->isFinishable());
		$this->assertEquals(true, $state->isCloseable());
		$this->assertEquals(true, $state->isSendingEmail());
		$this->assertEquals('#800000', $state->getColorCode());
		$this->assertEquals(2, $state->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $state->getLocales());
		$this->assertInstanceOf(State\StateLocale::class, $state->getLocale('pl'));
		$this->assertEquals('Nowy status', $state->getLocale('pl')->getName());
		$this->assertEquals('Temat maila', $state->getLocale('pl')->getEmailSubject());
		$this->assertEquals('Treść maila', $state->getLocale('pl')->getEmailBody());
		
		$this->assertArrayHasKey('en', $state->getLocales());
		$this->assertInstanceOf(State\StateLocale::class, $state->getLocale('en'));
		$this->assertEquals('New state', $state->getLocale('en')->getName());
		$this->assertEquals('Email subject', $state->getLocale('en')->getEmailSubject());
		$this->assertEquals('Email body', $state->getLocale('en')->getEmailBody());
		
		return $state;
	}
	
	/**
	 * @test
	 * @depends canCreateState
	 * @throws \Exception
	 */
	public function canUpdateState()
	{
		//given
		/** @var State\State $state */
		$state = \func_get_arg(0);
		$this->repository->save($state);
		
		$dataLocale = new DataLocale([
			'name__pl' => 'Status', 'name__en' => 'State',
			'email_subject__pl' => 'Temat', 'email_subject__en' => 'Subject',
			'email_body__pl' => 'Treść', 'email_body__en' => 'Body'
		]);
		
		//when
		$guid = $state->getUuid();
		$command = new Command\Command\State\UpdateState(
			$guid,
			$dataLocale->getAll('name'),
			$dataLocale->getAll('email_subject'),
			$dataLocale->getAll('email_body'),
			false,
			false,
			false,
			false,
			false,
			false,
			'#800001'
		);
		$this->handler->handle($command);
		
		//then
		$state = $this->repository->find($guid);
		
		$this->assertEquals($guid, $state->getUuid());
		$this->assertEquals(false, $state->isEditable());
		$this->assertEquals(false, $state->isDeletable());
		$this->assertEquals(false, $state->isRejectable());
		$this->assertEquals(false, $state->isFinishable());
		$this->assertEquals(false, $state->isCloseable());
		$this->assertEquals(false, $state->isSendingEmail());
		$this->assertEquals('#800001', $state->getColorCode());
		$this->assertEquals(2, $state->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $state->getLocales());
		$this->assertInstanceOf(State\StateLocale::class, $state->getLocale('pl'));
		$this->assertEquals('Status', $state->getLocale('pl')->getName());
		$this->assertEquals('Temat', $state->getLocale('pl')->getEmailSubject());
		$this->assertEquals('Treść', $state->getLocale('pl')->getEmailBody());
		
		$this->assertArrayHasKey('en', $state->getLocales());
		$this->assertInstanceOf(State\StateLocale::class, $state->getLocale('en'));
		$this->assertEquals('State', $state->getLocale('en')->getName());
		$this->assertEquals('Subject', $state->getLocale('en')->getEmailSubject());
		$this->assertEquals('Body', $state->getLocale('en')->getEmailBody());
	}
	
	/**
	 * @test
	 */
	public function canNotDeleteState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		
		$builder = State\Builder\State::init($uuid);
		$builder->setIsDeletable(false);
		$this->repository->save($builder->build());
		
		$command = new Command\Command\State\DeleteState($uuid);
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('cannot_remove_irremovable_state');
		$this->handler->handle($command);
	}

	/**
	 * @test
	 */
	public function canDeleteState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		
		$builder = State\Builder\State::init($uuid);
		$builder->setIsDeletable(true);
		$this->repository->save($builder->build());
		
		$command = new Command\Command\State\DeleteState($uuid);
		$this->handler->handle($command);
		
		$this->expectException(Persist\Exception\NotFound::class);
		$this->expectExceptionMessage('Entity not found');
		
		$this->repository->find((string)$uuid);
	}

	public function setUp()
	{
		$this->repository = new InMemoryStateRepository();
		$this->handler = new Command\CommandHandler\StateCommandHandler($this->repository);
	}
}