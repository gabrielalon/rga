<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\Persist;

use RGA\Infrastructure\SegregationSourcing\Aggregate;

class AggregateRepositoryTranslator
{
	/** @var Aggregate\Persist\AggregateRepository[] */
	private $repositories;
	
	/** @var AggregateRepositoryDecorator */
	private $repositoryDecorator;
	
	public function __construct()
	{
		$this->repositories = [];
		$this->repositoryDecorator = AggregateRepositoryDecorator::newInstance();
	}
	
	/**
	 * @param Aggregate\Persist\AggregateRepository $repository
	 */
	public function register(Aggregate\Persist\AggregateRepository $repository): void
	{
		$this->repositories[$repository->getAggregateRootClass()] = $repository;
	}
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
	 */
	public function record(Aggregate\AggregateRoot $aggregateRoot): void
	{
		$aggregateType = Aggregate\AggregateType::fromAggregateRoot($aggregateRoot);
		
		/** @var Aggregate\Persist\AggregateRepository $aggregateRepository */
		$aggregateRepository = $this->repositories[$aggregateType->getAggregateType()];
		
		$this->repositoryDecorator->recordAggregateRootInRepository($aggregateRoot, $aggregateRepository);
	}
}