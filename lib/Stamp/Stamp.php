<?php

namespace Stamp;

class Stamp
{
  function stamp($example, $time) {
    $translator = new Translator();
    return $translator->translate($example, $time);
  }
}