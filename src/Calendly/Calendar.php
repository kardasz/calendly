<?php

namespace Calendly;

/**
 * Class Calendar
 * @package Calendly
 */
class Calendar
{
    /**
     * @var EventCollection
     */
    private $collection;

    /**
     * @var \DateTime
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $to;

    /**
     * Calendar constructor.
     * @param \DateTime $from
     * @param \DateTime $to
     */
    public function __construct(\DateTime $from, \DateTime $to)
    {
        $this->collection = new EventCollection();
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        if (
            ($event->getFrom() <= $this->from && $event->getTo() >= $this->to) ||
            ($event->getFrom() >= $this->from && $event->getFrom() <= $this->to) ||
            ($event->getTo() >= $this->from && $event->getTo() <= $this->to)
        ) {
            $this->collection->add($event);
        }

        $this->processRepetition($event);
    }

    private function processRepetition (Event $event)
    {
        if ($event->isRepeat()) {
            $this->processRepetition($event);
        }
    }
}