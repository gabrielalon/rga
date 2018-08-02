<?php

namespace RGA\Infrastructure\Model\Identify;

interface GuidInterface
{
	/**
	 * @return string
	 */
	public function getId();
	
	/**
	 * @param string $id
	 */
	public function setId($id);
}