<?php
namespace Brtriver\DateRange;

use DateTime;
use DateInterval;
use DatePeriod;

class DateRange
{
    private $start;
    private $end;
    private $interval;
    const INTERVAL = 'P1D';

    public function __construct() {
        $num = func_num_args();
        if ($num === 2) {
            $this->start = self::convertToDateTime(func_get_arg(0));
            $this->end = self::convertToDateTime(func_get_arg(1));
        } elseif ($num === 1 && is_array(func_get_arg(0)) && count(func_get_arg(0)) === 2) {
            $startEndArray = func_get_arg(0);
            if (is_array($startEndArray) && count($startEndArray) === 2) {
                $values = array_values($startEndArray);
                $this->start = self::convertToDateTime($values[0]);
                $this->end = self::convertToDateTime($values[1]);
            }
        }
        $this->interval = new DateInterval(self::INTERVAL);
    }

    public function setInterval(DateInterval $interval)
    {
        $this->interval = $interval;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function getDatePeriod(DateInterval $interval = null)
    {
        return new DatePeriod($this->start, ($interval)?: $this->interval, $this->end);
    }

    public static function convertToDateTime($param)
    {
        if ($param instanceOf DateTime) {
            return $param;
        }
        if (strtotime($param) === false) {
            throw new \InvalidArgumentException('Invalid datetime string');
        }

        return new DateTime($param);
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function contains($dateString)
    {
        $date = self::convertToDateTime($dateString);
        $timestamp = $date->getTimestamp();

        return ($this->start->getTimestamp() <= $timestamp) && ($timestamp <= $this->end->getTimestamp());
    }
}