<?php

namespace Stamp;

class Stamp
{
    /**
     * @var array
     */
    private static $cache = array();

    /**
     * @param $example
     * @param $time
     * @return string
     * @throws \Exception
     */
    public function stamp($example, $time = null)
    {
        $translator = $this->fetchTranslator($example);

        if (is_null($time)) {
            $time = time();
        } else {
            // what is our argument?
            if (!is_numeric($time)) {
                if (is_string($time)) {
                    $time = strtotime($time);
                } elseif ($time instanceof \DateTime) {
                    $time = $time->getTimestamp();
                } else {
                    throw new \Exception('Invalid Date');
                }
            }
        }

        return $translator->translate($time);
    }

    /**
     * @param $example
     * @return Translator
     */
    private function fetchTranslator($example)
    {
        if (isset(self::$cache[$example])) {
            return self::$cache[$example];
        }

        $translator = new Translator($example);
        self::$cache[$example] = $translator;
        return $translator;
    }
}
