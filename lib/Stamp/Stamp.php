<?php

namespace Stamp;

class Stamp
{
  private $cache = array();

  public function stamp($example, $time)
  {

    $translator = $this->fetchTranslator( $example );

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



    return $translator->translate($time);
  }

  private function fetchTranslator($example) {
    if ( isset( $this->cache[$example] ) ) {
      echo 'cache hit';
      return $this->cache[$example];
    }

    return new Translator( $example );
  }
}
