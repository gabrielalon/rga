<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command\Command;
use RGA\Application\Command\CommandHandler;
use RGA\Domain\Model\Transport;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Test\Infrastructure\Persist\InMemoryTransportRepository;

class TransportCommandHandlerTest
	extends TestCase
{
	/** @var InMemoryTransportRepository */
	private $repository;
	
	/** @var CommandHandler\BehaviourCommandHandler */
	private $handler;
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function canCreateTransport()
	{
		//given
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$dataLocale = new DataLocale(['name__pl' => 'Transport', 'name__en' => 'Transport']);
		$aliases = ['default'];
		
		//when
		$command = new Command\Transport\CreateTransport($guid, true, $dataLocale->getAll('name'), $aliases, 'dpd');
		$this->handler->handle($command);
		
		//then
		$transport = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$transport->getUuid());
		$this->assertEquals(true, $transport->isActive());
		$this->assertEquals('dpd', $transport->getCourierSymbol());
		$this->assertEquals(2, $transport->getLocales()->count());
		$this->assertEquals(1, $transport->getAliases()->count());
		
		$this->assertArrayHasKey('pl', $transport->getLocales());
		$this->assertInstanceOf(Transport\TransportLocale::class, $transport->getLocale('pl'));
		$this->assertEquals('Transport', $transport->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $transport->getLocales());
		$this->assertInstanceOf(Transport\TransportLocale::class, $transport->getLocale('en'));
		$this->assertEquals('Transport', $transport->getLocale('en')->getName());
		
		$this->assertArrayHasKey('default', $transport->getAliases());
		
		return $transport;
	}
	
	/**
	 * @test
	 * @depends canCreateTransport
	 * @throws \Exception
	 */
	public function canUpdateTransport()
	{
		//given
		/** @var Transport\Transport $transport */
		$transport = \func_get_arg(0);
		$this->repository->save($transport);
		$guid = $transport->getUuid();
		$dataLocale = new DataLocale(['name__pl' => 'Transports', 'name__en' => 'Transports']);
		$aliases = ['ochnik'];
		
		//when
		$command = new Command\Transport\UpdateTransport($guid, false, $dataLocale->getAll('name'), $aliases, 'gls');
		$this->handler->handle($command);
		
		//then
		$transport = $this->repository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$transport->getUuid());
		$this->assertEquals(false, $transport->isActive());
		$this->assertEquals('gls', $transport->getCourierSymbol());
		$this->assertEquals(2, $transport->getLocales()->count());
		$this->assertEquals(1, $transport->getAliases()->count());
		
		$this->assertArrayHasKey('pl', $transport->getLocales());
		$this->assertInstanceOf(Transport\TransportLocale::class, $transport->getLocale('pl'));
		$this->assertEquals('Transports', $transport->getLocale('pl')->getName());
		
		$this->assertArrayHasKey('en', $transport->getLocales());
		$this->assertInstanceOf(Transport\TransportLocale::class, $transport->getLocale('en'));
		$this->assertEquals('Transports', $transport->getLocale('en')->getName());
		
		$this->assertArrayHasKey('ochnik', $transport->getAliases());
	}
	
	/**
	 * @test
	 */
	public function canDeleteDictionary(): void
	{
		$uuid = (string)\Ramsey\Uuid\Uuid::uuid4();
		
		$builder = Transport\Builder\Transport::init($uuid);
		$builder->setIsActive(true);
		$this->repository->save($builder->build());
		
		$command = new Command\Transport\DeleteTransport($uuid);
		$this->handler->handle($command);
		
		$this->expectException(NotFound::class);
		$this->expectExceptionMessage('Entity not found');
		
		$this->repository->find($uuid);
	}
	
	public function setUp()
	{
		$this->repository = new InMemoryTransportRepository();
		$this->handler = new CommandHandler\TransportCommandHandler($this->repository);
	}
}