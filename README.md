ValueObjects
============

[![Build Status](https://travis-ci.org/nicolopignatelli/valueobjects.png?branch=master)](https://travis-ci.org/nicolopignatelli/valueobjects)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/nicolopignatelli/valueobjects/badges/quality-score.png?s=979567c2d791ffbeab12777c60c8edb86776ddcc)](https://scrutinizer-ci.com/g/nicolopignatelli/valueobjects/)
[![Code Coverage](https://scrutinizer-ci.com/g/nicolopignatelli/valueobjects/badges/coverage.png?s=59dd4a142412a9dcd989870610f1c9f89c19cf48)](https://scrutinizer-ci.com/g/nicolopignatelli/valueobjects/)

A PHP 5.3+ library/collection of classes aimed to help developers with domain driven development and the use of immutable objects.

Installation
------------

Using [Composer](http://getcomposer.org/), require the `nicolopignatelli/valueobjects`
package:

``` javascript
{
    "require": {
        "nicolopignatelli/valueobjects": "dev-master"
    }
}
```

Otherwise, install the library and setup the autoloader yourself.


Covered types
-------------

_ValueObjects_ should cover every common type a developer could need in a DDD project. With this goal in mind, the object library should stay as generalistic as possible in order to be easily extendable and customizable in every single project.

Types list (mostly implemented as namespaces):

- [x] [Dates and time](/src/ValueObjects/DateTime)
- [x] [Numbers](/src/ValueObjects/Number)
- [x] [Strings](/src/ValueObjects/String)
- [x] [UUID](/src/ValueObjects/Identity)
- [x] [Person data (age, sex, etc...)](/src/ValueObjects/Person)
- [x] [Money and currencies](/src/ValueObjects/Money)
- [ ] TODO: Geographic data (coordinates, addresses, etc...)
- [ ] TODO: Internet related (URLs, email addresses, IPs, etc...)
- [ ] _Submit yours!_


Contributing
------------

See CONTRIBUTING file.


Running the Tests
-----------------

Install the [Composer](http://getcomposer.org/) `dev` dependencies:

    php composer.phar install --dev

Then, run the test suite:

    bin/phpunit


License
-------

Valueobjects is released under the MIT License. See the bundled LICENSE file for
details.
