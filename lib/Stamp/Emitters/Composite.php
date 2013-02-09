<?php

namespace Stamp\Emitters;

class Composite
{
  private $emitters = array();
  private $time;

  function format($time)
  {
    $result = '';
    foreach($this->emitters as $emitter) {
      $result .= $emitter->format($time);
    }

    return $result;
  }

  function add($emitter)
  {
    if ( is_array($emitter))
    {
      foreach($emitter as $e)
      {
        $this->emitters[] = $e;
      }
    }
    else
    {
      $this->emitters[] = $emitter;
    }
  }
}