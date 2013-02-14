<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class String extends BaseEmitter implements IBaseEmitter
{
    /**
     * @var string
     */
    public $field = 'string';

    /**
     * @param $format
     */
    public function __construct($format)
    {
        parent::__construct($format);
    }

    /**
     * @param $time
     * @return mixed
     */
    public function format($time)
    {
        return $this->format;
    }
}
