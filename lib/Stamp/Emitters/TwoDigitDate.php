<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class TwoDigitDate
{
  private $value;
  private $previous;
  private $time;

  function __construct($value, $previous)
  {
    $this->value = $value;
    $this->previous = $previous;
  }

  function format($time)
  {
    // do some magic and determine if we are lookign for month, date or year
    if ( $this->value >= 60 && $this->value <= 99 )
    {
      return $this->formatYear($time);
    }
    elseif ( $this->value == 12 )
    {
      return $this->formatMonth($time);
    }
    elseif ($this->value >= 13 && $this->value <= 31)
    {
      return $this->formatDay($time);
    }
    else
    {
      // see if we can figure it out by context
      // TODO
      return $this->formatMonth($time);
    }

  }

  private function formatYear($time)
  {
    return date("Y", $time);
  }

  private function formatDay($time)
  {
    return date("d", $time);
  }

  private function formatMonth($time)
  {
    return date("m", $time);
  }
}