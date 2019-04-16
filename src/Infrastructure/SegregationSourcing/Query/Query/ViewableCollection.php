<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Query;

interface ViewableCollection extends \Countable, \ArrayAccess, \Iterator
{
    /**
     * @return Viewable[]
     */
    public function all(): array;
}
