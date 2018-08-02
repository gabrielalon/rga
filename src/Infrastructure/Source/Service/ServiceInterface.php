<?php

namespace RGA\Infrastructure\Source\Service;

use RGA\Infrastructure\Source\Object;

interface ServiceInterface
{
	/**
	 * @return string
	 */
	public function sourceType();
	
	/**
	 * @param string $id
	 * @return Object\ObjectInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($id);
	
	/**
	 * @param string $itemId
	 * @return Object\ObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId);
}