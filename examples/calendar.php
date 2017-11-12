<?php

require_once __DIR__ . '/../vendor/autoload.php';

$event = new \Calendly\Event();
$event->setRepeat(true);
$event->setRepeatFrequency(\Calendly\Event::FREQUENCY_DAY);
$event->setRepeatInterval(3);
$event->setFrom(new DateTime('2017-10-22 10:00'));
$event->setTo(new DateTime('2017-10-22 12:30'));


$calendar = new \Calendly\Calendar(new DateTime("2017-11-01"), new DateTime("2017-11-31"));
$calendar->addEvent($event);

foreach ($calendar as $item) {
    echo sprintf("Event %s - %s\n", $item->getFrom()->format(\DateTime::ATOM), $item->getTo()->format(\DateTime::ATOM));
}