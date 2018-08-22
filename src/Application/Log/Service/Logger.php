<?php

namespace RGA\Application\Log\Service;

use RGA\Domain\Model\Log;
use RGA\Infrastructure\Log\Blamable\AdminInterface;
use RGA\Infrastructure\Log\Metadata\Loggable;
use RGA\Infrastructure\Log\Service\LoggerInterface;
use RGA\Infrastructure\Log\Type\LogTypeInterface;
use RGA\Infrastructure\Persist;

class Logger
	implements LoggerInterface
{
	/** @var Persist\Log\ChangeRepositoryInterface */
	private $changeRepository;
	
	/**
	 * @param Persist\Log\ChangeRepositoryInterface $changeRepository
	 */
	public function __construct(Persist\Log\ChangeRepositoryInterface $changeRepository)
	{
		$this->changeRepository = $changeRepository;
	}
	
	/**
	 * @param Loggable $meta
	 * @param LogTypeInterface $type
	 * @param AdminInterface $admin
	 */
	public function log(Loggable $meta, LogTypeInterface $type, AdminInterface $admin): void
	{
		$builder = Log\Builder\Change::init($meta->getUuid());
		$builder->setMetadata($meta->toArray());
		$builder->setType($type);
		$builder->setAdmin($admin);
		
		$this->changeRepository->save($builder->build());
	}
}