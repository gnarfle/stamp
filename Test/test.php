<?php
/* TODO: real tests... */
require __DIR__ . '/../vendor/autoload.php';

$stamp = new Stamp\Stamp();

// echo $stamp->stamp("Sat August 03 2011 PST 12:14PM", time());
// echo "\n";
// echo $stamp->stamp("04/23/2012 @ 4:13PM (Saturday)", time());
echo "\n";
echo $stamp->stamp("Jan 12, 1999", '2013-02-08 10:43:00');
echo "\n";