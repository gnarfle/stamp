<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class TwoDigitTime
{
  private $value;
  private $previous;
  private $time;
  public $field;

  public function __construct($value, $previous)
  {
    $this->value = intval($value);
    $this->previous = $previous;
  }

  public function format($time)
  {
    if ( $this->previous && $this->previous->field == 'hour' ) {
      // last was an hour, this will be minutes
      $this->field = 'minute';
      return date("i", $time);
    } elseif ( $this->previous && $this->previous->field == 'minute' ) {
      // last was minutes, this will be seconds'
      $this->field = 'second';
      return date("s", $time);
    } elseif ( $this->value >= 13 && $this->value <= 23 ) {
      // obvious 24 hour hour
      $this->field = 'hour';
      return date("H", $time);
    }

    // default to 12 hour hour
    $this->field = 'hour';
    return date("h", $time);
  }
}
