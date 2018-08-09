<?php

namespace RGA\Domain\Model\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate\Lang\Collector;

class DictionaryBuilder
{
	/** @var Dictionary */
	private $model;

	/**
	 * @param Dictionary $model
	 */
	public function __construct(Dictionary $model)
	{
		$this->model = $model;
	}

	/**
	 * @param UuidInterface $uuid
	 * @param string $type
	 * @param bool $isDeletable
	 * @return DictionaryBuilder
	 */
	public static function create(UuidInterface $uuid, string $type, bool $isDeletable): DictionaryBuilder
	{
		/** @var Dictionary $model */
		$model = new Dictionary($uuid, $type, $isDeletable);
		return new DictionaryBuilder($model);
	}

	/**
	 * @param ValueObject\Lang\Lang $lang
	 */
	public function setLang(ValueObject\Lang\Lang $lang): void
	{
		$collector = new Collector();
		foreach ($lang->getSupportedLanguageCodes() as $languageCode)
		{
			$builder = new DictionaryLangBuilder($languageCode);
			$name = $lang->getForLang('name', $languageCode);

			$collector->add($builder->create($name));
		}

		$this->model->setLang($collector);
	}

	/**
	 * @return Dictionary
	 */
	public function extract(): Dictionary
	{
		return $this->model;
	}
}