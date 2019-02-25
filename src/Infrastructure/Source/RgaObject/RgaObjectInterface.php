<?php

namespace RGA\Infrastructure\Source\RgaObject;

use RGA\Domain\Model\Rga\Rga\Applicant;

interface RgaObjectInterface
{
	/**
	 * @return integer
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getType(): string;
	
	/**
	 * @return Applicant\Applicant
	 */
	public function getApplicant(): Applicant\Applicant;
	
	/**
	 * @return Applicant\Address
	 */
	public function getAddress(): Applicant\Address;
	
	/**
	 * @return Applicant\Contact
	 */
	public function getContact(): Applicant\Contact;
	
	/**
	 * @return bool
	 */
	public function hasCompletedState(): bool;
	
	/**
	 * @return bool
	 */
	public function isPaid(): bool;
	
	/**
	 * @return int
	 */
	public function getCreatedAt(): int;
}