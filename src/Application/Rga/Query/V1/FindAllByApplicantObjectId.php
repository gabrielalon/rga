<?php

namespace RGA\Application\Rga\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindAllByApplicantObjectId extends QueryMessage
{
    /** @var integer */
    private $applicantObjectId;

    public function __construct(int $applicantObjectId)
    {
        $this->applicantObjectId = $applicantObjectId;
        $this->init();
    }

	public function getApplicantObjectId(): int
	{
		return $this->applicantObjectId;
	}
}
