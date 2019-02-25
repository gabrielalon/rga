<?php

namespace RGA\Application\Dictionary\Service;

use RGA\Application\Dictionary\Enum;
use RGA\Application\Dictionary\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class DictionaryQueryManager
	extends AbstractQueryManager
{
	/**
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAll(): Query\ReadModel\DictionaryCollection
	{
		$query = new Query\V1\FindAll();
		
		$this->handle($query);
		
		/** @var Query\ReadModel\DictionaryCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $type
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAllByType(string $type): Query\ReadModel\DictionaryCollection
	{
		$query = new Query\V1\FindAllByType($type);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\DictionaryCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $type
	 * @param string $uuid
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAllByTypeAndBehaviourUuid(string $type, string $uuid): Query\ReadModel\DictionaryCollection
	{
		$query = new Query\V1\FindAllByTypeAndBehaviourUuid($type, $uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\DictionaryCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAllReasonsAndBehaviourUuid(string $uuid): Query\ReadModel\DictionaryCollection
	{
		return $this->findAllByTypeAndBehaviourUuid(Enum\Type::REASON, $uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAllExpectationsAndBehaviourUuid(string $uuid): Query\ReadModel\DictionaryCollection
	{
		return $this->findAllByTypeAndBehaviourUuid(Enum\Type::EXPECTATION, $uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\DictionaryCollection
	 */
	public function findAllContactPreferencesAndBehaviourUuid(string $uuid): Query\ReadModel\DictionaryCollection
	{
		return $this->findAllByTypeAndBehaviourUuid(Enum\Type::CONTACT_PREFERENCE, $uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\Dictionary
	 */
	public function findOneByUuid(string $uuid): Query\ReadModel\Dictionary
	{
		$query = new Query\V1\FindOneByUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Dictionary $view */
		$view = $query->getView();
		
		return $view;
	}
}