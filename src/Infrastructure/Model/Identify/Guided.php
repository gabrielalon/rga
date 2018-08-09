<?php

namespace RGA\Infrastructure\Model\Identify;

use function get_called_class;

trait Guided
{
	/** @var string */
	protected $id;

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}

	/**
	 * @param string $uuid
	 * @return GuidInterface
	 */
	public static function init($uuid): GuidInterface
	{
		$class = get_called_class();

		/** @var GuidInterface $model */
		$model = new $class();
		$model->setId($uuid);

		return $model;
	}
}