<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command;
use RGA\Application\Log;
use RGA\Domain\Model\Base;
use RGA\Domain\Validation;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\Source\Warranty;

class RgaCommandHandler
	extends Command\CommandHandling\AbstractCommandHandler
{
	/** @var Warranty\ConfigInterface */
	private $config;
	
	/** @var Log\Service\Logger */
	private $logger;
	
	/** @var Persist\RgaRepositoryInterface */
	private $rgaRepository;
	
	/** @var Persist\Behaviour\BehaviourRepositoryInterface */
	private $behaviourRepository;
	
	/** @var Persist\State\StateRepositoryInterface */
	private $stateRepository;
	
	/** @var Persist\Transport\TransportRepositoryInterface */
	private $transportRepository;
	
	/**
	 * RgaCommandHandler constructor.
	 *
	 * @param Warranty\ConfigInterface $config
	 * @param Log\Service\Logger $logger
	 * @param Persist\RgaRepositoryInterface $rgaRepository
	 * @param Persist\Behaviour\BehaviourRepositoryInterface $behaviourRepository
	 * @param Persist\State\StateRepositoryInterface $stateRepository
	 * @param Persist\Transport\TransportRepositoryInterface $transportRepository
	 */
	public function __construct(
		Warranty\ConfigInterface $config,
		Log\Service\Logger $logger,
		Persist\RgaRepositoryInterface $rgaRepository,
		Persist\Behaviour\BehaviourRepositoryInterface $behaviourRepository,
		Persist\State\StateRepositoryInterface $stateRepository,
		Persist\Transport\TransportRepositoryInterface $transportRepository
	)
	{
		$this->config = $config;
		$this->logger = $logger;
		$this->rgaRepository = $rgaRepository;
		$this->behaviourRepository = $behaviourRepository;
		$this->stateRepository = $stateRepository;
		$this->transportRepository = $transportRepository;
	}
	
	/**
	 * @param Command\Command\Base\MakeRga $command
	 * @throws \Exception
	 */
	public function handleMakeRga(Command\Command\Base\MakeRga $command): void
	{
		try
		{
			$this->rgaRepository->beginTransaction();
			$groupNumber = $this->rgaRepository->getNextGroupNumber();
			
			foreach ($command->getObjectCollection()->getArrayCopy() as $objectItem)
			{
				$individualNumber = $this->rgaRepository->getNextIndividualNumber();
				
				$builder = Base\Builder\Rga::init($command->getUuid());
				$builder->setApplicant($command->getApplicant());
				$builder->setAddress($command->getAddress());
				$builder->setBank($command->getBank());
				$builder->setContact($command->getContact());
				$builder->setReferences($command->getReference());
				$builder->setObjectItem($objectItem);
				$builder->setNumbers($groupNumber, $individualNumber);
				
				$model = $builder->build();
				
				$rules = new Validation\Base\RgaValidationRules(
					$model,
					$command->getObject(),
					$this->config,
					$this->behaviourRepository,
					$this->stateRepository,
					$this->transportRepository
				);
				$this->validate($rules, $model);
				
				$this->rgaRepository->save($model);
				$this->logger->log($model, new Log\Type\MakeType(), $command->getAdmin());
			}
			
			$this->rgaRepository->commitTransaction();
		}
		catch (\Exception $e)
		{
			$this->rgaRepository->rollBackTransaction();
			
			throw $e;
		}
	}
	
	/**
	 * @param Command\Command\Base\UpdateRgaApplicant $command
	 */
	public function handleUpdateRgaApplicant(Command\Command\Base\UpdateRgaApplicant $command): void
	{
		$entity = $this->rgaRepository->find($command->getUuid());
		
		$builder = new Base\Builder\Rga($entity);
		$builder->setAddress($command->getAddress());
		$builder->setBank($command->getBank());
		$builder->setContact($command->getContact());
		
		$model = $builder->build();
		
		$this->validate(new Validation\Base\RgaApplicantValidationRules(), $model);
		
		$this->rgaRepository->save($model);
		$this->logger->log($model, new Log\Type\ChangeApplicantData(), $command->getAdmin());
	}
	
	/**
	 * @param Command\Command\Base\UpdateRgaNote $command
	 */
	public function handleUpdateRgaNote(Command\Command\Base\UpdateRgaNote $command): void
	{
		$entity = $this->rgaRepository->find($command->getUuid());
		
		$builder = new Base\Builder\Rga($entity);
		$builder->setAdminNotes($command->getNotes());
		
		$this->rgaRepository->save($builder->build());
		$this->logger->log($builder->build(), new Log\Type\ChangeNoteType(), $command->getAdmin());
	}
	
	/**
	 * @param Command\Command\Base\UpdateRgaState $command
	 */
	public function handleUpdateRgaState(Command\Command\Base\UpdateRgaState $command): void
	{
		$entity = $this->rgaRepository->find($command->getUuid());
		
		$builder = new Base\Builder\Rga($entity);
		$builder->setFlags($command->isProductReceived(), $command->isCashReturned(), $command->isProductReturned());
		$builder->setState($command->getStateUuid());
		$builder->setAdminNotesForApplicant($command->getNotesForApplicant());
		
		$model = $builder->build();
		
		$this->validate(new Validation\Base\RgaStateValidationRules($this->stateRepository), $model);
		
		$this->rgaRepository->save($model);
		$this->logger->log($model, new Log\Type\ChangeStateType(), $command->getAdmin());
	}
	
	/**
	 * @param Command\Command\Base\DeleteRga $command
	 */
	public function handleDeleteRga(Command\Command\Base\DeleteRga $command): void
	{
		$entity = $this->rgaRepository->find($command->getUuid());
		
		$builder = new Base\Builder\Rga($entity);
		$builder->markDeleted();
		
		$this->rgaRepository->save($builder->build());
		$this->logger->log($builder->build(), new Log\Type\DeleteType(), $command->getAdmin());
	}
}