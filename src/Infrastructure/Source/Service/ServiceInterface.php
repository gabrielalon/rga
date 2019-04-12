<?php

namespace RGA\Infrastructure\Source\Service;

use RGA\Infrastructure\Source\RgaObject;

interface ServiceInterface
{
	/**
	 * @return string
	 */
	public function sourceType(): string;
	
	/**
	 * @param string $encodeId
	 * @return RgaObject\RgaObjectInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($encodeId): RgaObject\RgaObjectInterface;
	
	/**
	 * @param string $itemId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId): RgaObject\RgaObjectItemInterface;
}