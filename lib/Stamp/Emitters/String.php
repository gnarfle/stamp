<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class String
{
  private $format;

  function __construct($format)
  {
    $this->format = $format;
  }

  function format($time)
  {
    return $this->format;
  }
}