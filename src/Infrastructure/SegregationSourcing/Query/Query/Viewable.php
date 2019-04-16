<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Query;

interface Viewable
{
    /**
     * @return string|integer
     */
    public function identifier();
}
