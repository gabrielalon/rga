<?php

namespace RGA\Application\Service\Rga;

use RGA\Application\Service\DataProviderInterface;

interface RgaPackageDataProvider
	extends DataProviderInterface
{
	/**
	 * @return string
	 */
	public function packageNo(): string;
	
	/**
	 * @return \DateTimeImmutable
	 */
	public function setAt(): \DateTimeImmutable;
}