<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command\Command\Behaviour\CreateBehaviour;
use RGA\Application\Command\CommandHandler\BehaviourCommandHandler;
use RGA\Domain\ValueObject\Behaviour\Behaviour;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepositoryInterface;
use RGA\Test\Infrastructure\Persist\InMemoryBehaviourRepository;

class BehaviourCommandHandlerTest extends TestCase
{
	/**
	 * @var BehaviourRepositoryInterface
	 */
	private $behaviourRepository;
	/**
	 * @var BehaviourCommandHandler
	 */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateBehaviour()
	{
		//given
		$valueObject = new Behaviour('return', true);
		$lang = new Lang([
			'pl' => [
				'name' => 'zwrot testowy'
			]
		]);

		//when
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$this->handler->handle(new CreateBehaviour($guid, $valueObject, $lang));

		//then
		$behaviour = $this->behaviourRepository->load($guid);
		$this->assertEquals($guid, $behaviour->getId());
	}

	public function setUp()
	{
		$this->behaviourRepository = new InMemoryBehaviourRepository();
		$this->handler = new BehaviourCommandHandler(
			$this->behaviourRepository
		);
	}
}