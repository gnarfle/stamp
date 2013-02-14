<?php

namespace Stamp\Emitters;

abstract class BaseEmitter implements IBaseEmitter
{
    /**
     * @var
     */
    protected $format;

    /**
     * @param $format
     */
    public function __construct($format)
    {
        $this->format = $format;
    }
}
