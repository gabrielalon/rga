<?php

namespace RGA\Test\Application\Command\CommandHandler;

use PHPUnit\Framework\TestCase;
use RGA\Application\Command;
use RGA\Application\Log\Service\Logger;
use RGA\Domain\Model\Base;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Domain\Model\Source\RgaObjectBuilder;
use RGA\Domain\Model\Source\RgaObjectItem;
use RGA\Domain\Model\Source\RgaObjectItemBuilder;
use RGA\Domain\Model\Source\RgaObjectItemCollector;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Log\Service\LoggerInterface;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\Source\Warranty\Config;
use RGA\Infrastructure\Source\Warranty\ConfigInterface;
use RGA\Test\Infrastructure\Persist as PersistTest;
use RGA\Test\Mock\Application\Source\Service\OrderService;
use RGA\Test\Mock\Domain\Model\Behaviour\ComplaintBehaviour;
use RGA\Test\Mock\Domain\Model\Behaviour\ReturnBehaviour;
use RGA\Test\Mock\Domain\Model\State\NewState;
use RGA\Test\Mock\Domain\Model\State\SendState;
use RGA\Test\Mock\Domain\Model\Transport\DpdTransport;

class RgaCommandHandlerTest
	extends TestCase
{
	/** @var ConfigInterface */
	private $config;
	
	/** @var LoggerInterface */
	private $logger;
	
	/** @var RgaObject */
	private $rgaObject;
	
	/** @var Persist\RgaRepositoryInterface */
	private $rgaRepository;
	
	/** @var Persist\Behaviour\BehaviourRepositoryInterface */
	private $behaviourRepository;
	
	/** @var Persist\State\StateRepositoryInterface */
	private $stateRepository;
	
	/** @var Persist\Transport\TransportRepositoryInterface */
	private $transportRepository;
	
	/** @var Command\CommandHandler\RgaCommandHandler */
	private $handler;
	
	/**
	 * @return ValueObject\Base\ObjectItemCollection
	 */
	private function getObjectItemCollection()
	{
		$collection = new ValueObject\Base\ObjectItemCollection();
		
		/** @var RgaObjectItem $item */
		foreach ($this->rgaObject->getItems() as $item)
		{
			$collection->add(new ValueObject\Base\ObjectItem(
				date('Y-m-d', $this->rgaObject->getCreatedAt()),
				$this->rgaObject->getType(),
				$this->rgaObject->getId(),
				$item->getId(),
				$this->rgaObject->getId(),
				$item->getName(),
				'reason',
				'expectation',
				'incident',
				$item->getVariantId(),
				$item->getName(),
				new ValueObject\Base\AttachmentCollection([])
			));
		}
		
		return $collection;
	}
	
	/**
	 * @test
	 * @throws \Exception
	 */
	public function canMakeRga()
	{
		//given
		$newState = new NewState();
		$returnBehaviour = new ReturnBehaviour();
		$dpdTransport = new DpdTransport();
		
		$guid = \Ramsey\Uuid\Uuid::uuid4();
		$bank = new ValueObject\Applicant\Bank('test', '000000000000000000');
		$reference = new ValueObject\Base\Reference($newState->getUuid(), $returnBehaviour->getUuid(), $dpdTransport->getUuid());
		$admin = new ValueObject\Base\BlamableAdmin('test test', 0);
		
		//when
		$command = new Command\Command\Base\MakeRga(
			$guid,
			$this->rgaObject->getApplicant(),
			$this->rgaObject->getAddress(),
			$this->rgaObject->getContact(),
			$bank,
			$this->getObjectItemCollection(),
			$reference,
			$this->rgaObject,
			$admin
		);
		
		$this->handler->handle($command);
		
		//then
		$rga = $this->rgaRepository->find((string)$guid);
		
		$this->assertEquals($guid, (string)$rga->getUuid());
		
		$this->assertEquals($returnBehaviour->getUuid(), $rga->getBehaviourUuid());
		$this->assertEquals($newState->getUuid(), $rga->getStateUuid());
		$this->assertEquals($dpdTransport->getUuid(), $rga->getTransportUuid());
		
		$this->assertEquals($this->rgaObject->getType(), $rga->getSourceObjectType());
		$this->assertEquals($this->rgaObject->getId(), $rga->getSourceObjectID());
		$this->assertEquals($this->rgaObject->getId(), $rga->getApplicantGivenSourceIdentification());
		
		$this->assertEquals($this->rgaObject->getApplicant()->getId(), $rga->getApplicantObjectID());
		$this->assertEquals($this->rgaObject->getApplicant()->getType(), $rga->getApplicantObjectType());
		
		$this->assertEquals($this->rgaObject->getContact()->getEmail(), $rga->getApplicantEmail());
		$this->assertEquals($this->rgaObject->getContact()->getTelephone(), $rga->getApplicantTelephone());
		$this->assertEquals($this->rgaObject->getContact()->getPreferredForm(), $rga->getApplicantContactPreference());
		
		$this->assertEquals($this->rgaObject->getAddress()->getFullName(), $rga->getApplicantFullName());
		$this->assertEquals($this->rgaObject->getAddress()->getCountryCode(), $rga->getApplicantCountryCode());
		$this->assertEquals($this->rgaObject->getAddress()->getCity(), $rga->getApplicantCity());
		$this->assertEquals($this->rgaObject->getAddress()->getPostalCode(), $rga->getApplicantPostalCode());
		$this->assertEquals($this->rgaObject->getAddress()->getApartmentNumber(), $rga->getApplicantApartmentNumber());
		$this->assertEquals($this->rgaObject->getAddress()->getBuildingNumber(), $rga->getApplicantBuildingNumber());
		$this->assertEquals($this->rgaObject->getAddress()->getStreetName(), $rga->getApplicantStreetName());
		
		$this->assertEquals($bank->getName(), $rga->getApplicantBankName());
		$this->assertEquals($bank->getAccountNumber(), $rga->getApplicantBankAccountNumber());
		
		/** @var RgaObjectItem $item */
		foreach ($this->rgaObject->getItems() as $item)
		{
			$this->assertEquals($item->getId(), $rga->getSourceObjectItemID());
			$this->assertEquals($item->getName(), $rga->getProductName());
			$this->assertEquals($item->getName(), $rga->getApplicantGivenProductName());
			$this->assertEquals($item->getVariantId(), $rga->getProductVariantID());
		}
		
		return $rga;
	}
	
	/**
	 * @test
	 * @depends canMakeRga
	 * @throws \Exception
	 */
	public function canUpdateApplicantData()
	{
		//given
		/** @var Base\Rga $rga */
		$rga = \func_get_arg(0);
		$uuid = (string)$rga->getUuid();
		$this->rgaRepository->save($rga);
		$admin = new ValueObject\Base\BlamableAdmin('test test', 0);
		
		$address = new ValueObject\Applicant\Address(
			'testowy test',
			'testowa',
			'test',
			12,
			'12-120',
			'Testowo',
			'pl'
		);
		$contact = $this->rgaObject->getContact();
		$bank = new ValueObject\Applicant\Bank('testowy', '100000000000000000');
		
		//when
		$command = new Command\Command\Base\UpdateRgaApplicant($uuid, $address, $contact, $bank, $admin);
		$this->handler->handle($command);
		
		//then
		$rga = $this->rgaRepository->find((string)$uuid);
		
		$this->assertEquals($contact->getEmail(), $rga->getApplicantEmail());
		$this->assertEquals($contact->getTelephone(), $rga->getApplicantTelephone());
		$this->assertEquals($contact->getPreferredForm(), $rga->getApplicantContactPreference());
		
		$this->assertEquals($address->getFullName(), $rga->getApplicantFullName());
		$this->assertEquals($address->getCountryCode(), $rga->getApplicantCountryCode());
		$this->assertEquals($address->getCity(), $rga->getApplicantCity());
		$this->assertEquals($address->getPostalCode(), $rga->getApplicantPostalCode());
		$this->assertEquals($address->getApartmentNumber(), $rga->getApplicantApartmentNumber());
		$this->assertEquals($address->getBuildingNumber(), $rga->getApplicantBuildingNumber());
		$this->assertEquals($address->getStreetName(), $rga->getApplicantStreetName());
		
		$this->assertEquals($bank->getName(), $rga->getApplicantBankName());
		$this->assertEquals($bank->getAccountNumber(), $rga->getApplicantBankAccountNumber());
	}
	
	/**
	 * @test
	 * @depends canMakeRga
	 * @throws \Exception
	 */
	public function canUpdateAdminNotes()
	{
		//given
		/** @var Base\Rga $rga */
		$rga = \func_get_arg(0);
		$uuid = (string)$rga->getUuid();
		$this->rgaRepository->save($rga);
		$admin = new ValueObject\Base\BlamableAdmin('test test', 0);
		
		//when
		$command = new Command\Command\Base\UpdateRgaNote($uuid, 'test', $admin);
		$this->handler->handle($command);
		
		//then
		$rga = $this->rgaRepository->find((string)$uuid);
		
		$this->assertEquals($command->getNotes(), $rga->getAdminNotes());
	}
	
	/**
	 * @test
	 * @depends canMakeRga
	 * @throws \Exception
	 */
	public function canChangeState()
	{
		//given
		/** @var Base\Rga $rga */
		$rga = \func_get_arg(0);
		$uuid = (string)$rga->getUuid();
		$this->rgaRepository->save($rga);
		$admin = new ValueObject\Base\BlamableAdmin('test test', 0);
		$newState = new SendState();
		
		//when
		$command = new Command\Command\Base\UpdateRgaState($uuid, $newState->getUuid(), true, true, true, 'test', $admin);
		$this->handler->handle($command);
		
		//then
		$rga = $this->rgaRepository->find((string)$uuid);
		
		$this->assertEquals($newState->getUuid(), $rga->getStateUuid());
		$this->assertEquals($command->isProductReturned(), $rga->isProductReturned());
		$this->assertEquals($command->isProductReceived(), $rga->isProductReceived());
		$this->assertEquals($command->isCashReturned(), $rga->isCashReturned());
		$this->assertEquals($command->getNotesForApplicant(), $rga->getAdminNotesForApplicant());
	}
	
	/**
	 * @test
	 * @depends canMakeRga
	 * @throws \Exception
	 */
	public function canDeleteRga()
	{
		//given
		/** @var Base\Rga $rga */
		$rga = \func_get_arg(0);
		$uuid = (string)$rga->getUuid();
		$this->rgaRepository->save($rga);
		$admin = new ValueObject\Base\BlamableAdmin('test test', 0);
		
		//when
		$command = new Command\Command\Base\DeleteRga($uuid, $admin);
		$this->handler->handle($command);
		
		//then
		$rga = $this->rgaRepository->find((string)$uuid);
		
		$this->assertEquals(true, $rga->isDeleted());
	}
	
	public function setUp()
	{
		$this->config = new Config();
		$this->logger = new Logger(new PersistTest\InMemoryChangeRepository());
		$this->rgaRepository = new PersistTest\InMemoryRgaRepository();
		
		$this->behaviourRepository = new PersistTest\InMemoryBehaviourRepository();
		$this->behaviourRepository->save(new ReturnBehaviour());
		$this->behaviourRepository->save(new ComplaintBehaviour());
		
		$this->stateRepository = new PersistTest\InMemoryStateRepository();
		$this->stateRepository->save(new NewState());
		$this->stateRepository->save(new SendState());
		
		$this->transportRepository = new PersistTest\InMemoryTransportRepository();
		$this->transportRepository->save(new DpdTransport());
		
		$orderService = new OrderService();
		$this->rgaObject = $orderService->buildObject(1);
		
		$this->handler = new Command\CommandHandler\RgaCommandHandler(
			$this->config,
			$this->logger,
			$this->rgaRepository,
			$this->behaviourRepository,
			$this->stateRepository,
			$this->transportRepository
		);
	}
}