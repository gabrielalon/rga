<?php

namespace RGA\Application\Command\Command\Transport;

use RGA\Domain\ValueObject\Lang\Lang;

class CreateTransport
{
	/** @var string */
	private $id;

	/** @var boolean */
	private $active;

	/** @var Lang */
	private $names;

	/** @var array */
	private $domainIDs;

	/** @var integer */
	private $shipmentMethodID;
}