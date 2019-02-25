<?php

namespace RGA\Application\Attachment\Service;

use RGA\Application\Attachment\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class AttachmentQueryManager
	extends AbstractQueryManager
{
	/**
	 * @param int $page
	 * @param int $limit
	 * @return Query\ReadModel\AttachmentCollection
	 */
	public function findAll(int $page, int $limit): Query\ReadModel\AttachmentCollection
	{
		$query = new Query\V1\FindAll($page, $limit);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\AttachmentCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\AttachmentCollection
	 */
	public function findAllByRgaUuid(string $uuid): Query\ReadModel\AttachmentCollection
	{
		$query = new Query\V1\FindAllByRgaUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\AttachmentCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\Attachment
	 */
	public function findOneByUuid(string $uuid): Query\ReadModel\Attachment
	{
		$query = new Query\V1\FindOneByUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\Attachment $view */
		$view = $query->getView();
		
		return $view;
	}
}