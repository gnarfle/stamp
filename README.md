# PHP Stamp

Simple date formatting for humans. Based on the ruby package of the same name, stamp
allows you to easily format dates without having to remember arcane arguments to
pass to date().

## Status

Stamp should be fully functional, it passes all the tests that it's ruby cousin does.
That said there is a bit of code cleanup and performance enhancements that need to be done
but it should be very usable right now.

## TODO

* Adhere to PSR-2 standards
* Performance analysis / cache emitters
* Internationalisation? 

## Usage

Stamp can be loaded using the Composer autoloader or an autoloader of your choice.

Usage is simple:

```php
$stamp = new Stamp\Stamp();
$stamp->stamp("August 14th 2012", time()); // February 9th 2013
$stamp->stamp("04/23/2012 @ 4:13PM (Saturday)", time()) // 02/09/2013 @ 10:50AM (Sunday)
```

For a more complete list of examples, check out the [Test Suite](https://github.com/chadcf/stamp/blob/master/features/stamp.feature)

## Limitations

There are some instances where it will be difficult to guess what your example really means,
so it is best to supply example strings that are not ambiguous. For example the following 
example will fail if you intend it to be mm/dd/yyyy:

```php
$stamp->stamp("4/4/2012", time());
```

The reason for this is that the information provided makes it impossible to distinguish between m/d/y
or d/y/m since both single digit values are valid for both month or day. To avoid this it is best to
supply example days > 12 and example months < 12.
