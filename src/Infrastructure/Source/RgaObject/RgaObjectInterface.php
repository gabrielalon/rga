<?php

namespace RGA\Infrastructure\Source\Object;

use RGA\Domain\ValueObject\Applicant;

interface ObjectInterface
{
	/**
	 * @return string
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getType();
	
	/**
	 * @return Applicant\Applicant
	 */
	public function getApplicant();
	
	/**
	 * @return Applicant\Address
	 */
	public function getAddress();
	
	/**
	 * @return Applicant\Contact
	 */
	public function getContact();
	
	/**
	 * @return int
	 */
	public function getCreatedAt();
}