<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class Lookup
{
  private $format;

  function __construct($format)
  {
    $this->format = $format;
  }

  function format($time)
  {
    return date($this->format, $time);
  }
}