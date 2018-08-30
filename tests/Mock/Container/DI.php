<?php

namespace RGA\Test\Mock\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RGA\Domain\Model;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\Source\Warranty\ConfigInterface;
use RGA\Test\Infrastructure;

class DI
	implements ContainerInterface
{
	/** @var array */
	private $map = [];
	
	/** @var DI */
	private static $instance;
	
	/**
	 * @param array $map
	 */
	public function __construct(array $map)
	{
		$this->map = $map;
	}
	
	/**
	 * @return DI
	 */
	public static function newInstance(): DI
	{
		if (null === DI::$instance)
		{
			DI::$instance = new DI([
				SnapshotRepositoryInterface::class => new Infrastructure\SegregationSourcing\Snapshot\InMemorySnapshotRepository(),
				EventStreamRepositoryInterface::class => new Infrastructure\SegregationSourcing\Event\InMemoryEventStreamRepository(),
				Model\Dictionary\Projection\DictionaryProjectorInterface::class => new Infrastructure\Dictionary\Projection\InMemoryDictionaryProjector(),
				Model\Behaviour\Projection\BehaviourProjectorInterface::class => new Infrastructure\Behaviour\Projection\InMemoryBehaviourProjector(),
				Model\State\Projection\StateProjectorInterface::class => new Infrastructure\State\Projection\InMemoryStateProjector(),
				Model\Transport\Projection\TransportProjectorInterface::class => new Infrastructure\Transport\Projection\InMemoryTransportProjector(),
				Model\Attachment\Projection\AttachmentProjectorInterface::class => new Infrastructure\Attachment\Projection\InMemoryAttachmentProjector(),
				Model\Rga\Projection\RgaProjectorInterface::class => new Infrastructure\Rga\Projection\InMemoryRgaProjector(),
				ConfigInterface::class => new Model\Rga\Integration\Warranty\Config()
			]);
		}
		
		return DI::$instance;
	}
	
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
	 * @throws ContainerExceptionInterface Error while retrieving the entry.
	 *
	 * @return mixed Entry.
	 */
	public function get($id)
	{
		if (false === $this->has($id))
		{
			throw new \RuntimeException('Definition not found of: ' . $id);
		}
		
		return $this->map[$id];
	}
	
	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has($id)
	{
		return isset($this->map[$id]);
	}
}