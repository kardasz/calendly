<?php

namespace Calendly;

/**
 * Class Event
 * @package Calendly
 */
class Event
{
    /**
     * @var \DateTime
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $to;

    /**
     * @var bool
     */
    private $repeat = false;

    /**
     * Repeat frequency (day, week, month, year)
     * @var string
     */
    private $repeatFrequency;

    /**
     * Repeat interval
     *
     * @var int
     */
    private $repeatInterval = 0;

    const FREQUENCY_DAY   = 'day';
    const FREQUENCY_MONTH = 'month';
    const FREQUENCY_WEEK  = 'week';
    const FREQUENCY_YEAR  = 'year';

    /**
     * @return \DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \DateTime $from
     */
    public function setFrom(\DateTime $from)
    {
        $this->from = $from;
    }

    /**
     * @return \DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param \DateTime $to
     */
    public function setTo(\DateTime $to)
    {
        $this->to = $to;
    }

    /**
     * @return bool
     */
    public function isRepeat(): bool
    {
        return $this->repeat;
    }

    /**
     * @param bool $repeat
     */
    public function setRepeat(bool $repeat)
    {
        $this->repeat = $repeat;
    }

    /**
     * @return string
     */
    public function getRepeatFrequency()
    {
        return $this->repeatFrequency;
    }

    /**
     * @param string $repeatFrequency
     */
    public function setRepeatFrequency(string $repeatFrequency)
    {
        $this->repeatFrequency = $repeatFrequency;
    }

    /**
     * @return int
     */
    public function getRepeatInterval(): int
    {
        return $this->repeatInterval;
    }

    /**
     * @param int $repeatInterval
     */
    public function setRepeatInterval(int $repeatInterval)
    {
        $this->repeatInterval = $repeatInterval;
    }
}