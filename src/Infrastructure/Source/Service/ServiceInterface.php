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
	 * @param string $id
	 * @return RgaObject\RgaObjectInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObject($id);

	/**
	 * @param string $itemId
	 * @return RgaObject\RgaObjectItemInterface
	 * @throws \InvalidArgumentException
	 */
	public function buildObjectItem($itemId);
}