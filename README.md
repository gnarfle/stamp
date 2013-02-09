# PHP Stamp

Simple date formatting for humans. Based on the ruby package of the same name, stamp
allows you to easily format dates without having to remember arcane arguments to
pass to date().

## Status

Not ready for primetime. This is an intial rough port. 

## TODO

* Implement time parsing
* Implement more intelligent two digit date parsing
* Implement tests
* allow passing date strings, date objects, or timestamps
* Adhere to PSR standards
* Performance analysis

## Usage

Stamp can be loaded using the Composer autoloder or an autoloader of your choice.
Usage is simple:

```php
$stamp = new Stamp\Stamp();
$stamp->stamp("August 14th 2012", time());
=> February 9th 2013
```

The first argument is an example string used to build a date format. At this point I have
not yet implemented intelligent 2 digit date parsing, so for best results try to use 
values that are not ambiguous. This should improve shortly... 
