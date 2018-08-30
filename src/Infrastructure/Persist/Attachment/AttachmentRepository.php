<?php

namespace RGA\Infrastructure\Persist\Attachment;

use RGA\Domain\Model\Attachment\Attachment;
use RGA\Infrastructure\SegregationSourcing\Aggregate\Persist\AggregateRepository;

class AttachmentRepository
	extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Attachment::class;
	}
	
	/**
	 * @param Attachment $attachment
	 */
	public function save(Attachment $attachment): void
	{
		$this->saveAggregateRoot($attachment);
	}
	
	/**
	 * @param string $uuid
	 * @return Attachment
	 */
	public function find(string $uuid): Attachment
	{
		/** @var Attachment $attachment */
		$attachment = $this->findAggregateRoot($uuid);
		
		return $attachment;
	}
}