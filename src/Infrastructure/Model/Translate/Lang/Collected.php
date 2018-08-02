<?php

namespace RGA\Infrastructure\Model\Translate\Lang;

trait Collected
{
	/** @var Collector */
	protected $lang;
	
	/**
	 * @param Collector $collector
	 */
	public function setLang(Collector $collector)
	{
		$this->lang = $collector;
	}
	
	/**
	 * @return Collector
	 */
	public function getLang()
	{
		return $this->lang;
	}
}