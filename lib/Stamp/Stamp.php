<?php

namespace Stamp;

class Stamp
{
  public function stamp($example, $time)
  {
    $translator = new Translator();

    return $translator->translate($example, $time);
  }
}
