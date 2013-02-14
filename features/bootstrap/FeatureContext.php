<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $date;
    private $stamp;
    private $stamped;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^the date (\w+) (\d+), (\d{4})$/
     */
    public function theDate($month, $day, $year)
    {
        $this->date = strtotime("$month $day, $year");
    }

    /**
     * @When /^I stamp the example "([^"]*)"$/
     */
    public function iStampTheExample($example)
    {
        $stamp = new Stamp\Stamp();
        $this->stamped = $stamp->stamp($example, $this->date);
    }

    /**
     * @Then /^I produce "([^"]*)"$/
     */
    public function iProduce($expected)
    {
        assertEquals($this->stamped, $expected);
    }


    /**
     * @Given /^the time zone is "([^"]*)"$/
     */
    public function theTimeZoneIs($tz)
    {
        date_default_timezone_set($tz);
    }

    /**
     * @Given /^the time (\w+) (\d+), (\d+) at (\d{2}):(\d{2}):(\d{2})$/
     */
    public function theTimeFebruaryAt($month, $day, $year, $hour, $minute, $second)
    {
        $this->date = strtotime("$month $day, $year $hour:$minute:$second");
    }
}

