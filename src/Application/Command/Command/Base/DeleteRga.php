<?php

namespace RGA\Application\Command\Command\Base;

use RGA\Infrastructure\Command\Command\CommandInterface;
use RGA\Domain\ValueObject;

class DeleteRga
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var ValueObject\Base\BlamableAdmin */
	private $admin;
	
	/**
	 * @param string $uuid
	 * @param ValueObject\Base\BlamableAdmin $admin
	 */
	public function __construct(string $uuid, ValueObject\Base\BlamableAdmin $admin)
	{
		$this->uuid = $uuid;
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
	 * @return ValueObject\Base\BlamableAdmin
	 */
	public function getAdmin(): ValueObject\Base\BlamableAdmin
	{
		return $this->admin;
	}
}