<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class String
{
  private $format;
  public $field = 'string';

  public function __construct($format)
  {
    $this->format = $format;
  }

  public function format($time)
  {
    return $this->format;
  }
}
