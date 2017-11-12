<?php

namespace Calendly;

use Traversable;

/**
 * Class Calendar
 * @package Calendly
 */
class Calendar implements \IteratorAggregate
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
     * @var \DateInterval
     */
    private $range;

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
        $this->range = $to->diff($from, true);
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
            $shift = $event->getFrom()->diff($this->from, true);
            $duration = $event->getFrom()->diff($event->getTo(), true);
            switch ($event->getRepeatFrequency()) {
                case Event::FREQUENCY_DAY:
                    $shiftDays = (int)$shift->format("%a");
                    $repeatedEvent = clone $event;
                    $multiplier = floor($shiftDays/$event->getRepeatInterval());
                    $options = null;
                    if ($multiplier > 0) {
                        $shiftInterval = new \DateInterval(sprintf(
                            "P%dD", ($multiplier*$event->getRepeatInterval())
                        ));
                        $repeatedEvent->getFrom()->add($shiftInterval);
                        $repeatedEvent->getTo()->add($shiftInterval);
                        $options = \DatePeriod::EXCLUDE_START_DATE;
                    }

                    $interval = new \DateInterval(sprintf(
                        "P%dD", $event->getRepeatInterval()
                    ));

                    $period = new \DatePeriod(clone $repeatedEvent->getFrom(), $interval, $this->to, $options);
                    foreach ($period as $date) {
                        $eventCopy = clone $repeatedEvent;
                        $eventCopy->setFrom($date);
                        $eventCopy->setTo((clone $date)->add($duration));

                        $this->collection->add($eventCopy);
                    }


                break;
                case Event::FREQUENCY_WEEK:


                    break;
                case Event::FREQUENCY_MONTH:


                    break;
            }


        }
    }

    /**
     * @return EventCollection
     */
    public function getCollection(): EventCollection
    {
        return $this->collection;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return $this->collection;
    }
}