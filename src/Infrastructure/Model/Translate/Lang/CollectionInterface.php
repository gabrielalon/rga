<?php

namespace RGA\Infrastructure\Model\Translate\Lang;

interface CollectionInterface
{
	/**
	 * @param Collector $collector
	 */
	public function setLang(Collector $collector);
	
	/**
	 * @return Collector
	 */
	public function getLang();
}