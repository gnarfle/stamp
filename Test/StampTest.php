<?php
require __DIR__ . '/../vendor/autoload.php';

class StampTest extends PHPUnit_Framework_TestCase
{
  private $time;
  private $stamp;

  protected function setUp()
  {
    $this->time = strtotime('2013-02-08 10:43:00');
    $this->stamp = new Stamp\Stamp();
  }

  public function testDates()
  {
    $examples = array(
      'January'                   => 'February',
      'Jan'                       => 'Feb',
      'Jan 1'                     => 'Feb 8',
      'Jan 10'                    => 'Feb 08',
      'Jan 1, 1999'               => 'Feb 8, 2013',
      'Jan 12, 1999'              => 'Feb 08, 2013',
      '13 January 1999'           => '08 February 2013',
      'Monday'                    => 'Friday',
      'Tue, Jan 1'                => 'Fri, Feb 8',
      'Tuesday, January 1, 1999'  => 'Friday, February 8, 2013',
      '01/1999'                   => '02/2013',
      '01/01'                     => '02/08',
      '01/31'                     => '02/08',
      '01/99'                     => '02/13',
      '01/01/1999'                => '02/08/2013',
      '12/31/00'                  => '02/08/13',
      '31/12'                     => '08/02',
      '31/12/99'                  => '08/02/13',
      '21-Jan-1999'               => '08-Feb-2013',
      '1999-12-31'                => '2013-02-08',
      'DOB: 12-31-1999'           => 'DOB: 02-08-2013'
    );

    foreach( $examples as $example => $expected )
    {
      $output = $this->stamp->stamp($example, $this->time);
      $this->assertEquals($expected, $output);
    }
  }
}