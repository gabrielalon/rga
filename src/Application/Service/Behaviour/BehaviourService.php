<?php

namespace RGA\Application\Service\Behaviour;

use RGA\Application\Service;
use RGA\Domain\Model\Behaviour\Command;

class BehaviourService
	extends Service\AbstractService
{
	/**
	 * @param BehaviourDataProvider $provider
	 */
	public function create(BehaviourDataProvider $provider): void
	{
		$command = new Command\CreateBehaviour(
			$provider->uuid(),
			$provider->type(),
			$provider->names(),
			$provider->activation()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param BehaviourDataProvider $provider
	 */
	public function change(BehaviourDataProvider $provider): void
	{
		$command = new Command\ChangeBehaviour(
			$provider->uuid(),
			$provider->names(),
			$provider->activation()
		);
		
		$this->handle($command);
	}
}