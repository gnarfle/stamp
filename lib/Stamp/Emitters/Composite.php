<?php

namespace Stamp\Emitters;

class Composite extends BaseEmitter implements IBaseEmitter
{
    /**
     * @var array
     */
    private $emitters = array();

    public function __construct()
    {

    }

    /**
     * @param $time
     * @return string
     */
    public function format($time)
    {
        $result = '';
        /**
         * @var BaseEmitter $emitter
         */
        foreach ($this->emitters as $emitter) {
            $result .= $emitter->format($time);
        }

        return $result;
    }

    /**
     * @param $emitter
     * @return mixed
     * @todo fix no return on not array
     */
    public function add($emitter)
    {
        if ($emitter) {
            $this->emitters[] = $emitter;
            return $emitter;
        }
    }
}
