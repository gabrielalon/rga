<?php

namespace RGA\Test\Application\Command\CommandHandler;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RGA\Application\Command\Command\State\CreateState;
use RGA\Application\Command\Command\State\DeleteState;
use RGA\Application\Command\CommandHandler\StateCommandHandler;
use RGA\Domain\Model\State\State;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\State\StateRepositoryInterface;
use RGA\Test\Infrastructure\Persist\InMemoryStateRepository;

class StateCommandHandlerTest extends TestCase
{
	/**
	 * @var StateRepositoryInterface
	 */
	private $stateRepository;
	/**
	 * @var StateCommandHandler
	 */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$command = new CreateState(
			$uuid,
			new Lang([
				'pl' => 'nowe',
				'en' => 'new'
			]),
			new Lang([
				'pl' => 'test'
			]),
			new Lang([
				'pl' => 'test test test'
			]),
			'#F67A71'
		);
		$command->setIsSendingEmail(false);

		$this->handler->handle($command);

		$state = $this->stateRepository->load($uuid);
		$this->assertEquals($uuid, $state->getUuid());
	}

	/**
	 * @test
	 */
	public function canDeleteState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$model = new State(
			$uuid,
			true,
			'#F67A71',
			new Lang([
				'pl' => 'nowe',
				'en' => 'new'
			]),
			new Lang([
				'pl' => 'test'
			]),
			new Lang([
				'pl' => 'test test test'
			])
		);
		$model->setIsDeletable(true);
		$this->stateRepository->save($model);
		$command = new DeleteState($uuid);

		$this->handler->handle($command);
		$this->expectException(NotFound::class);
		$this->expectExceptionMessage('Entity not found');
		$state = $this->stateRepository->load($uuid);
	}

	/**
	 * @test
	 */
	public function canNotDeleteState(): void
	{
		$uuid = \Ramsey\Uuid\Uuid::uuid4();
		$model = new State(
			$uuid,
			true,
			'#F67A71',
			new Lang([
				'pl' => 'nowe',
				'en' => 'new'
			]),
			new Lang([
				'pl' => 'test'
			]),
			new Lang([
				'pl' => 'test test test'
			])
		);
		$model->setIsDeletable(false);
		$this->stateRepository->save($model);
		$command = new DeleteState($uuid);
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('cannot_remove_irremovable_state');
		$this->handler->handle($command);
	}

	public function setUp()
	{
		$this->stateRepository = new InMemoryStateRepository();
		$this->handler = new StateCommandHandler(
			$this->stateRepository
		);
	}
}