<?php

namespace Calendly;

/**
 * Class EventCollection
 * @package Calendly
 */
class EventCollection
{
    /**
     * @var Event[]
     */
    private $collection = [];

    /**
     * @param Event $event
     */
    public function add (Event $event)
    {
        $this->collection[] = $event;
    }

    /**
     * @return Event[]
     */
    public function toArray()
    {
        return $this->collection;
    }

}