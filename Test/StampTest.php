<?php
require __DIR__ . '/../vendor/autoload.php';

class StampTest extends PHPUnit_Framework_TestCase
{
  private $time;
  private $stamp;

  protected function setUp()
  {
    $this->time = time();
    $this->stamp = new Stamp\Stamp();
  }

  public function testMatchers()
  {
    $examples = array(

    );
  }
}