<?php

namespace RGA\Infrastructure\Source\ObjectQuery;

use RGA\Infrastructure\Source\Object;

interface ObjectQueryInterface
{
	/**
	 * @param string $type
	 * @param integer $id
	 * @return Object\ObjectInterface
	 * @throws \RuntimeException
	 */
	public function getByObjectInfo($type, $id);
	
	/**
	 * @param string $type
	 * @param integer $itemId
	 * @return Object\ObjectItemInterface
	 * @throws \RuntimeException
	 */
	public function getByObjectItemInfo($type, $itemId);
}