<?php

namespace Stamp\Emitters;

class Composite
{
    private $emitters = array();
    private $time;

    public function format($time)
    {
        $result = '';
        foreach ($this->emitters as $emitter) {
            $result .= $emitter->format($time);
        }

        return $result;
    }

    public function add($emitter)
    {
        if ($emitter) {
            $this->emitters[] = $emitter;
            return $emitter;
        }
    }
}
