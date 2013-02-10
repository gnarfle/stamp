<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class AmPm
{
  private $format;
  public $field = 'meridian';

  public function __construct($format = 'lowercase')
  {
    $this->format = $format;
  }

  public function format($time)
  {
    $am = 'am';
    $pm = 'pm';

    if ($this->format == 'uppercase') {
      $am = 'AM';
      $pm = 'PM';
    }

    if ( date('G', $time) < 12 ) {
      return $am;
    }

    return $pm;
  }
}
