<?php

namespace RGA\Domain\Model\Behaviour;

class BehaviourLangBuilder
{
	/** @var string */
	private $languageCode;
	
	/**
	 * @param string $languageCode
	 */
	public function __construct($languageCode)
	{
		$this->languageCode = $languageCode;
	}
	
	/**
	 * @param string $name
	 * @return BehaviourLang
	 */
	public function create($name)
	{
		$model = new BehaviourLang();
		$model->setLanguageCode($this->languageCode);
		$model->setName($name);
		
		return $model;
	}
}