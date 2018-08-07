<?php

namespace RGA\Infrastructure\Source\RgaObject;

interface RgaObjectItemInterface
{
	/**
	 * @return int
	 */
	public function getId();
	
	/**
	 * @return int
	 */
	public function getVariantId();
	/**
	 * @return bool
	 */
	public function isTransport();
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @return int
	 */
	public function getObjectId();
	
	/**
	 * @return int
	 */
	public function getWarranty();
}