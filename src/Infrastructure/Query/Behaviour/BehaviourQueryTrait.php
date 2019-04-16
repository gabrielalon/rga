<?php


namespace RGA\Infrastructure\Query\Behaviour;

use RGA\Application\Behaviour\Query;
use RGA\Domain\Model\Behaviour\Behaviour as VO;

trait BehaviourQueryTrait
{
    /**
     * @param Query\ReadModel\BehaviourCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\BehaviourCollection $collection, \stdClass $row): void
    {
        if (true === $collection->has($row->uuid)) {
            $view = $collection->get($row->uuid)
                ->addName($row->locale, $row->name);
        } else {
            $view = Query\ReadModel\Behaviour::fromUuid($row->uuid)
                ->setType(VO\Type::fromString((string)$row->type))
                ->setActivation(VO\Active::fromBoolean((bool)$row->is_active))
                ->addName($row->locale, $row->name);
        }
        
        $collection->add($view);
    }
}
