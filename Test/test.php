<?php
/* TODO: real tests... */
require __DIR__ . '/../vendor/autoload.php';

$stamp = new Stamp\Stamp();

$examples = array(

);

echo $stamp->stamp("August 03 2011 PST", time());