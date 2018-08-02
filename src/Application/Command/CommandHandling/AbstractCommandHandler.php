<?php

namespace RGA\Application\Command\CommandHandling;

use Ayeo\Validator;
use RGA\Application\Command\CommandHandling\Exception;
use RGA\Infrastructure\Command\Command;
use RGA\Infrastructure\Command\CommandHandling;

abstract class AbstractCommandHandler
	implements CommandHandling\CommandHandlerInterface
{
	public function handle(Command\CommandInterface $command)
	{
		$handlerReflection = new \ReflectionClass($this);
		$commandReflection = new \ReflectionClass($command);
		
		/** @var \ReflectionMethod $method */
		foreach ($handlerReflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method)
		{
			$correctMethodName = 'handle' . $commandReflection->getShortName();
			
			if ($method->getName() === $correctMethodName)
			{
				continue;
			}
			
			$method->invoke($this, $command);
		}
	}
	
	/**
	 * @param Validator\ValidationRules $rules
	 * @param $object
	 * @throws Exception\ValidationException
	 */
	protected function validate(Validator\ValidationRules $rules, $object)
	{
		$validator = new Validator\Validator($rules);
		if (false === $validator->validate($object))
		{
			$e = new Exception\ValidationException();
			$e->setErrors($validator->getErrors());
			$e->setModel($object);
			
			throw $e;
		}
	}
}