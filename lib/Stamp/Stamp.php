<?php

namespace Stamp;

class Stamp
{
  public function stamp($example, $time)
  {
    $translator = new Translator();

    // what is our argument?
    if ( !is_numeric($time) )
    {
      if ( is_string($time) )
      {
        $time = strtotime($time);
      }
      elseif( is_object( $time ) && get_class($time) == 'DateTime')
      {
        $time = $time->getTimestamp();
      }
      else
      {
        throw new Exception('Invalid date');
      }
    }
    return $translator->translate($example, $time);
  }
}
