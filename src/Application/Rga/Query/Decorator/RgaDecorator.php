<?php

namespace RGA\Application\Rga\Query\Decorator;

use RGA\Application\Rga\Query\ReadModel\Rga;

class RgaDecorator
{
	/**
	 * @param Rga $rga
	 * @param string $glue
	 * @return string
	 */
	public function extractApplicantAddress(Rga $rga, string $glue = '\n'): string
	{
		$rows = [
			\sprintf('%s %s', $rga->applicantStreetName(), $rga->applicantBuildingNumber()),
			$rga->applicantApartmentNumber() ? '/' . $rga->applicantApartmentNumber() : '',
			\sprintf(', %s %s', $rga->applicantPostalCode(), $rga->applicantCity())
		];
		
		return \implode($glue, $rows);
	}
}