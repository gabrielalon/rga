<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command\Command;
use RGA\Application\Command\CommandHandler;
use RGA\Application\Command\CommandHandling\Exception\ValidationException;
use RGA\Application\Enum\Behaviour\BehaviourType;
use RGA\Domain\Model\Behaviour\BehaviourLocale;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepositoryInterface;
use RGA\Test\Infrastructure\Persist\InMemoryBehaviourRepository;

class BehaviourCommandHandlerTest extends TestCase
{
	/** @var BehaviourRepositoryInterface */
	private $repository;
	
	/** @var CommandHandler\BehaviourCommandHandler */
	private $handler;

	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateReturnBehaviour()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale(['name__pl' => 'Zwrot', 'name__en' => 'Return']);

		//when
		$command = new Command\Behaviour\CreateBehaviour($guid, BehaviourType::RETURN_TYPE, false, $dataLocale->getAll('name'));
		$this->handler->handle($command);

		//then
		$behaviour = $this->repository->find((string)$guid);

		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(false, $behaviour->isActive());
		$this->assertEquals(BehaviourType::RETURN_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('Zwrot', $behaviour->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('Return', $behaviour->getLocale('en')->getName());
		
		return $behaviour;
	}
	
	/**
	 * @test
	 * @depends canCreateReturnBehaviour
	 * @throws \Exception
	 */
	public function canUpdateReturnBehaviour()
	{
		//given
		/** @var \RGA\Domain\Model\Behaviour\Behaviour $behaviour */
		$behaviour = \func_get_arg(0);
		$this->repository->save($behaviour);
		
		$dataLocale = new DataLocale(['name__pl' => 'Zwroty', 'name__en' => 'Returns']);
		
		//when
		$guid = $behaviour->getUuid();
		$command = new Command\Behaviour\UpdateBehaviour($guid, BehaviourType::RETURN_TYPE, true, $dataLocale->getAll('name'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(true, $behaviour->isActive());
		$this->assertEquals(BehaviourType::RETURN_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('Zwroty', $behaviour->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('Returns', $behaviour->getLocale('en')->getName());
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateComplaintBehaviour()
	{
		//given
		$dataLocale = new DataLocale(['name__pl' => 'Reklamacja', 'name__en' => 'Complaint']);
		
		//when
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$command = new Command\Behaviour\CreateBehaviour($guid, BehaviourType::COMPLAINT_TYPE, true, $dataLocale->getAll('name'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(true, $behaviour->isActive());
		$this->assertEquals(BehaviourType::COMPLAINT_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('Reklamacja', $behaviour->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('Complaint', $behaviour->getLocale('en')->getName());
		
		return $behaviour;
	}
	
	/**
	 * @test
	 * @depends canCreateComplaintBehaviour
	 * @throws \Exception
	 */
	public function canUpdateComplaintBehaviour()
	{
		//given
		/** @var \RGA\Domain\Model\Behaviour\Behaviour $behaviour */
		$behaviour = \func_get_arg(0);
		$this->repository->save($behaviour);
		$dataLocale = new DataLocale(['name__pl' => 'Reklamacje', 'name__en' => 'Complaints']);
		
		//when
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$command = new Command\Behaviour\CreateBehaviour($guid, BehaviourType::COMPLAINT_TYPE, false, $dataLocale->getAll('name'));
		$this->handler->handle($command);
		
		//then
		$behaviour = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$behaviour->getUuid());
		$this->assertEquals(false, $behaviour->isActive());
		$this->assertEquals(BehaviourType::COMPLAINT_TYPE, $behaviour->getType());
		$this->assertEquals(2, $behaviour->getLocales()->count());
		
		$this->assertArrayHasKey('pl', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('pl'));
		$this->assertEquals('Reklamacje', $behaviour->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $behaviour->getLocales());
		$this->assertInstanceOf(BehaviourLocale::class, $behaviour->getLocale('en'));
		$this->assertEquals('Complaints', $behaviour->getLocale('en')->getName());
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function cannotCreateBehaviour()
	{
		//given
		$dataLocale = new DataLocale([]);
		
		//then
		$this->expectException(ValidationException::class);
		
		//when
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$command = new Command\Behaviour\CreateBehaviour($guid, BehaviourType::COMPLAINT_TYPE, true, $dataLocale->getAll('name'));
		$this->handler->handle($command);
	}

	public function setUp()
	{
		$this->repository = new InMemoryBehaviourRepository();
		$this->handler = new CommandHandler\BehaviourCommandHandler($this->repository);
	}
}