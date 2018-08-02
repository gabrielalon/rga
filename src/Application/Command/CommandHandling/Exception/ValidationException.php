<?php

namespace RGA\Application\Command\CommandHandling\Exception;

class ValidationException
	extends \RuntimeException
{
	/** @var \Ayeo\Validator\Error[] */
	private $errors = [];
	
	/** @var object */
	private $model;
	
	/**
	 * @return \Ayeo\Validator\Error[]
	 */
	public function getErrors()
	{
		return $this->errors;
	}
	
	/**
	 * @param \Ayeo\Validator\Error[] $errors
	 */
	public function setErrors($errors)
	{
		$this->errors = $errors;
	}
	
	/**
	 * @return object
	 */
	public function getModel()
	{
		return $this->model;
	}
	
	/**
	 * @param object $model
	 */
	public function setModel($model)
	{
		$this->model = $model;
	}
}