<?php

namespace RGA\Application\Service\ReturnPackage;

use Ayeo\Price\Price;
use RGA\Application\Service\DataProviderInterface;

interface ReturnPackageDataProvider
	extends DataProviderInterface
{
	/**
	 * @return int
	 */
	public function id(): int;
	
	/**
	 * @return string
	 */
	public function rgaUuid(): string;
	
	/**
	 * @return string
	 */
	public function transportUuid(): string;
	
	/**
	 * @return Price
	 */
	public function price(): Price;
	
	/**
	 * @return string
	 */
	public function packageNo(): string;
	
	/**
	 * @return \DateTimeImmutable
	 */
	public function setAt(): string;
}