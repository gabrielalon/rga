<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot;

class SnapshotDto
{
	/** @var string */
	private $root;
	
	/** @var integer */
	private $version;
	
	/** @var \DateTime */
	private $created;
	
	/**
	 * @param int $version
	 * @return SnapshotDto
	 */
	public static function fromVersion(int $version): SnapshotDto
	{
		return (new static())->setVersion($version);
	}
	
	/**
	 * @return string
	 */
	public function getRoot(): string
	{
		return $this->root;
	}
	
	/**
	 * @param string $root
	 * @return SnapshotDto
	 */
	public function setRoot(string $root): SnapshotDto
	{
		$this->root = $root;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getVersion(): int
	{
		return $this->version;
	}
	
	/**
	 * @param int $version
	 * @return SnapshotDto
	 */
	public function setVersion(int $version): SnapshotDto
	{
		$this->version = $version;
		
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getCreated(): \DateTime
	{
		return $this->created;
	}
	
	/**
	 * @param \DateTime $created
	 * @return SnapshotDto
	 */
	public function setCreated(\DateTime $created): SnapshotDto
	{
		$this->created = $created;
		
		return $this;
	}
}