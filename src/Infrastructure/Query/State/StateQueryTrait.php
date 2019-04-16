<?php

namespace RGA\Infrastructure\Query\State;

use RGA\Application\State\Query;
use RGA\Domain\Model\State\State as VO;

trait StateQueryTrait
{
    /**
     * @param Query\ReadModel\StateCollection $collection
     * @param \stdClass $row
     */
    public function populateCollectionWithData(Query\ReadModel\StateCollection $collection, \stdClass $row): void
    {
        if (true === $collection->has($row->uuid)) {
            $view = $collection->get($row->uuid)
                ->addName($row->locale, $row->name)
                ->addEmailSubject($row->locale, $row->email_subject)
                ->addEmailBody($row->locale, $row->email_body);
        } else {
            $view = Query\ReadModel\State::fromUuid($row->uuid)
                ->setIsEditable(VO\IsEditable::fromBoolean((bool)$row->is_editable))
                ->setIsDeletable(VO\IsDeletable::fromBoolean((bool)$row->is_deletable))
                ->setIsRejectable(VO\IsRejectable::fromBoolean((bool)$row->is_rejectable))
                ->setIsFinishable(VO\IsFinishable::fromBoolean((bool)$row->is_finishable))
                ->setIsCloseable(VO\IsCloseable::fromBoolean((bool)$row->is_closeable))
                ->setIsSendingEmail(VO\IsSendingEmail::fromBoolean((bool)$row->is_sending_email))
                ->setColorCode(VO\ColorCode::fromString((string)$row->color_code))
                ->addName($row->locale, $row->name)
                ->addEmailSubject($row->locale, $row->email_subject)
                ->addEmailBody($row->locale, $row->email_body);
        }
        
        $collection->add($view);
    }
}
