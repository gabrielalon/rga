<?php

namespace RGA\Application\Rga\Service;

use RGA\Application\Rga\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class RgaQueryManager
	extends AbstractQueryManager
{
	/**
	 * @param int $page
	 * @param int $limit
	 * @return Query\ReadModel\RgaCollection
	 */
	public function findAll(int $page, int $limit): Query\ReadModel\RgaCollection
	{
		$query = new Query\V1\FindAll($page, $limit);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\RgaCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $code
	 * @return Query\ReadModel\Rga
	 */
	public function findOneByCode(string $code): Query\ReadModel\Rga
	{
		$query = new Query\V1\FindOneByCode($code);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Rga $rga */
		$rga = $query->getView();
		
		return $rga;
	}
	
	/**
	 * @param string $hash
	 * @return Query\ReadModel\Rga
	 */
	public function findOneByHash(string $hash): Query\ReadModel\Rga
	{
		$query = new Query\V1\FindOneByHash($hash);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Rga $rga */
		$rga = $query->getView();
		
		return $rga;
	}
	
	/**
	 * @param int $individualNumber
	 * @return Query\ReadModel\Rga
	 */
	public function findOneByIndividualNumber(int $individualNumber): Query\ReadModel\Rga
	{
		$query = new Query\V1\FindOneByIndividualNumber($individualNumber);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Rga $rga */
		$rga = $query->getView();
		
		return $rga;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\Rga
	 */
	public function findOneByUuid(string $uuid): Query\ReadModel\Rga
	{
		$query = new Query\V1\FindOneByUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Rga $rga */
		$rga = $query->getView();
		
		return $rga;
	}
}