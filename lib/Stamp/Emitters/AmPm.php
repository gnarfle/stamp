<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class AmPm extends BaseEmitter implements IBaseEmitter
{
    /**
     * @var string
     */
    public $field = 'meridian';

    /**
     * @param string $format
     */
    public function __construct($format = 'lowercase')
    {
        parent::__construct($format);
    }

    /**
     * @param $time
     * @return string
     */
    public function format($time)
    {
        $am = 'am';
        $pm = 'pm';

        if ($this->format == 'uppercase') {
            $am = 'AM';
            $pm = 'PM';
        }

        if (date('G', $time) < 12) {
            return $am;
        }

        return $pm;
    }
}
