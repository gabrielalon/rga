<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

use RGA\Application\Additional\Service\AdditionalQueryManager;
use RGA\Application\Attachment\Service\AttachmentQueryManager;
use RGA\Application\Behaviour\Service\BehaviourQueryManager;
use RGA\Application\Dictionary\Service\DictionaryQueryManager;
use RGA\Application\ReturnPackage\Service\ReturnPackageQueryManager;
use RGA\Application\Rga\Service\RgaQueryManager;
use RGA\Application\SegregationSourcing\Service\StorageEventQueryManager;
use RGA\Application\Source\Service\RgaObjectQueryManager;
use RGA\Application\State\Service\StateQueryManager;
use RGA\Application\Transport\Service\TransportQueryManager;

class QueryManager
{
	/** @var QueryManagerRegistry */
	private $registry;
	
	/**
	 * @param QueryManagerRegistry $registry
	 */
	public function __construct(QueryManagerRegistry $registry)
	{
		$this->registry = $registry;
	}
	
	/**
	 * @return AdditionalQueryManager
	 */
	public function additional(): AdditionalQueryManager
	{
		return $this->registry->get(AdditionalQueryManager::class);
	}
	
	/**
	 * @return AttachmentQueryManager
	 */
	public function attachment(): AttachmentQueryManager
	{
		return $this->registry->get(AttachmentQueryManager::class);
	}
	
	/**
	 * @return BehaviourQueryManager
	 */
	public function behaviour(): BehaviourQueryManager
	{
		return $this->registry->get(BehaviourQueryManager::class);
	}
	
	/**
	 * @return DictionaryQueryManager
	 */
	public function dictionary(): DictionaryQueryManager
	{
		return $this->registry->get(DictionaryQueryManager::class);
	}
	/**
	 * @return ReturnPackageQueryManager
	 */
	public function returnPackage(): ReturnPackageQueryManager
	{
		return $this->registry->get(ReturnPackageQueryManager::class);
	}
	
	/**
	 * @return RgaQueryManager
	 */
	public function rga(): RgaQueryManager
	{
		return $this->registry->get(RgaQueryManager::class);
	}
	
	/**
	 * @return RgaObjectQueryManager
	 */
	public function source(): RgaObjectQueryManager
	{
		return $this->registry->get(RgaObjectQueryManager::class);
	}
	
	/**
	 * @return StateQueryManager
	 */
	public function state(): StateQueryManager
	{
		return $this->registry->get(StateQueryManager::class);
	}
	
	/**
	 * @return StorageEventQueryManager
	 */
	public function ss(): StorageEventQueryManager
	{
		return $this->registry->get(StorageEventQueryManager::class);
	}
	
	/**
	 * @return TransportQueryManager
	 */
	public function transport(): TransportQueryManager
	{
		return $this->registry->get(TransportQueryManager::class);
	}
}