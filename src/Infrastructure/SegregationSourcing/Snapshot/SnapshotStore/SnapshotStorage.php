<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore;

use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot\Snapshot;

class SnapshotStorage
{
    use Aggregate\AggregateTranslatorTrait;
    
    /** @var SnapshotRepositoryInterface */
    private $snapshotRepository;
    
    /** @var SerializerInterface */
    private $serializer;
    
    /**
     * @param SnapshotRepositoryInterface $snapshotRepository
     */
    public function __construct(SnapshotRepositoryInterface $snapshotRepository)
    {
        $this->serializer = new CallbackSerializer(null, null);
        
        $this->snapshotRepository = $snapshotRepository;
        $this->snapshotRepository->setSerializer($this->serializer);
    }
    
    /**
     * @param Aggregate\AggregateRoot $aggregateRoot
     */
    public function make(Aggregate\AggregateRoot $aggregateRoot)
    {
        $snapshot = new Snapshot(
            Aggregate\AggregateType::fromAggregateRoot($aggregateRoot),
            $this->getAggregateTranslator()->extractAggregateId($aggregateRoot),
            $this->serializer->serialize($aggregateRoot),
            $this->getAggregateTranslator()->extractAggregateVersion($aggregateRoot),
            new \DateTime('now')
        );
        
        $this->snapshotRepository->save($snapshot);
    }
    
    /**
     * @param Aggregate\AggregateType $aggregateType
     * @param string $aggregateId
     * @return Snapshot
     */
    public function get(Aggregate\AggregateType $aggregateType, $aggregateId)
    {
        $dto = $this->snapshotRepository->get($aggregateType, $aggregateId);
        
        return new Snapshot(
            $aggregateType,
            $aggregateId,
            $this->serializer->unserialize($dto->getRoot()),
            $dto->getVersion(),
            $dto->getCreated()
        );
    }
}
