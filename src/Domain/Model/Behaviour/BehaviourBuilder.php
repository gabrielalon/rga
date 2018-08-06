<?php

namespace RGA\Domain\Model\Behaviour;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate\Lang\Collector;

class BehaviourBuilder
{
	/** @var Behaviour */
	private $model;
	
	/**
	 * @param Behaviour $model
	 */
	public function __construct(Behaviour $model)
	{
		$this->model = $model;
	}
	
	/**
	 * @param UuidInterface $uuid
	 * @return BehaviourBuilder
	 */
	public static function create(UuidInterface $uuid)
	{
		/** @var Behaviour $model */
		$model = Behaviour::init($uuid);
		
		return new BehaviourBuilder($model);
	}
	
	/**
	 * @param ValueObject\Behaviour\Behaviour $behaviour
	 */
	public function setBehaviour(ValueObject\Behaviour\Behaviour $behaviour)
	{
		$this->model->setIsActive($behaviour->isActive());
		$this->model->setType($behaviour->getType());
	}
	
	/**
	 * @param ValueObject\Lang\Lang $lang
	 */
	public function setLang(ValueObject\Lang\Lang $lang): void
	{
		$collector = new Collector();
		foreach ($lang->getSupportedLanguageCodes() as $languageCode)
		{
			$builder = new BehaviourLangBuilder($languageCode);
			$name = $lang->getForLang('name', $languageCode);
			
			$collector->add($builder->create($name));
		}
		
		$this->model->setLang($collector);
	}
	
	/**
	 * @return Behaviour
	 */
	public function extract(): Behaviour
	{
		return $this->model;
	}
}