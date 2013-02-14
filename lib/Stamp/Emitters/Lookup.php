<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class Lookup extends BaseEmitter implements IBaseEmitter
{
    /**
     * @var string
     */
    public $field;

    /**
     * @param $format
     */
    public function __construct($format)
    {
        parent::__construct($format);
        switch ($format) {
            case 'F':
            case 'M':
                $this->field = 'month';
                break;
            case 'l':
            case 'D':
            case 'j':
                $this->field = 'day';
                break;
            case 'Y':
                $this->field = 'year';
                break;
            case 'T':
                $this->field = 'tz';
                break;
            case 'g':
                $this->field = 'hour';
        }
    }

    /**
     * @param $time
     * @return string
     */
    public function format($time)
    {
        return date($this->format, $time);
    }
}
