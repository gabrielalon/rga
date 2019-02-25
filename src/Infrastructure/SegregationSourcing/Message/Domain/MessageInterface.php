<?php

namespace RGA\Infrastructure\SegregationSourcing\Message\Domain;

interface MessageInterface
{
	/**
	 * @return string
	 */
	public function messageName();
}