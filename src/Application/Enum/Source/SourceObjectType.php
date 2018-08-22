<?php

namespace RGA\Application\Enum\Source;

use RGA\Application\Enum\AbstractEnum;

class SourceObjectType
	extends AbstractEnum
{
	const UNKNOWN_TYPE = 'unknown';
	const ORDER_TYPE = 'order';
	const TRADE_DOCUMENT_TYPE = 'trade_document';
}