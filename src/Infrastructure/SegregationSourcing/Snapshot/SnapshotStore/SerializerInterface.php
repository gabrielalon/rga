<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore;

interface SerializerInterface
{
    /**
     * @param mixed $data
     * @return string
     */
    public function serialize($data);
    
    /**
     * @param string $data
     * @return mixed
     */
    public function unserialize($data);
}
