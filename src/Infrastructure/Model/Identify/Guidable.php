<?php

namespace RGA\Infrastructure\Model\Identify;

interface Guidable
{
	/**
	 * @return string
	 */
	public function getUuid();
	
	/**
	 * @param string $id
	 */
	public function setUuid($id);
}