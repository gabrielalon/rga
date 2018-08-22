<?php

namespace RGA\Infrastructure\Source\RgaObject;

interface RgaObjectItemInterface
{
	/**
	 * @return integer
	 */
	public function getId(): int;
	
	/**
	 * @return integer
	 */
	public function getVariantId(): int;
	
	/**
	 * @return boolean
	 */
	public function isTransport(): bool;
	
	/**
	 * @return string
	 */
	public function getName(): string;
	
	/**
	 * @return integer
	 */
	public function getObjectId(): int;
	
	/**
	 * @return integer|null
	 */
	public function getFinalDateOfComplaint(): ?int;
	
	/**
	 * @return integer|null
	 */
	public function getFinalDateOfReturn(): ?int;
	
	/**
	 * @return integer|null
	 */
	public function getWarranty(): ?int;
}