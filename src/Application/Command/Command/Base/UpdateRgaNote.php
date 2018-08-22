<?php

namespace RGA\Application\Command\Command\Base;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Command\Command\CommandInterface;

class UpdateRgaNote
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var string */
	private $notes;
	
	/** @var ValueObject\Base\BlamableAdmin */
	private $admin;
	
	/**
	 * @param string $uuid
	 * @param string $notes
	 * @param ValueObject\Base\BlamableAdmin $admin
	 */
	public function __construct(
		string $uuid,
		string $notes,
		ValueObject\Base\BlamableAdmin $admin
	)
	{
		$this->uuid = $uuid;
		$this->notes = $notes;
		$this->admin = $admin;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return string
	 */
	public function getNotes(): string
	{
		return $this->notes;
	}
	
	/**
	 * @return ValueObject\Base\BlamableAdmin
	 */
	public function getAdmin(): ValueObject\Base\BlamableAdmin
	{
		return $this->admin;
	}
}