<?php
/*
 * Responsible for looking up and formatting date parts
 */

namespace Stamp\Emitters;

class Ordinal extends BaseEmitter implements IBaseEmitter
{
    /**
     * @var
     */
    private $value;

    /**
     * @var string
     */
    public $field = 'day';

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $time
     * @return string
     */
    public function format($time)
    {
        return $this->ordinalize($time);
    }

    /**
     * @param $time
     * @return string
     */
    private function ordinalize($time)
    {
        /* I'm making the assumption that no one wants 03rd, so we will return no leading zero */
        $day = date("j", $time);
        $val = intval($day);

        if ($val % 100 >= 11 && $val % 100 <= 13) {
            $ordinal = 'th';
        } else {
            switch ($val % 10) {
                case 1:
                    $ordinal = 'st';
                    break;
                case 2:
                    $ordinal = 'nd';
                    break;
                case 3:
                    $ordinal = 'rd';
                    break;
                default:
                    $ordinal = 'th';
            }
        }

        return $day . $ordinal;
    }
}
