<?php

namespace RGA\Test\Mock\Domain\Model\Transport;

use RGA\Domain\Model\Transport\Transport;

class DpdTransport
	extends Transport
{
	public function __construct()
	{
		$this->setUuid('34ad5170-aa47-4c52-b884-e05daed11abb');
	}
}