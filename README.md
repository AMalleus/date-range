DateRange is Simpe Date Range Object for PHP
==============================================

DateRange is a simple representation of date range for PHP.

Requirements
------------

DateRange works with PHP 5.4.0 or later.

Install
--------

The recommended way to install date-range is with composer.

```bash
$ composer require brtriver/date-range
```

Usage
------

### Instance

Pass two date(start and end) args like below:

```php
use Brtriver\DateRange\DateRange;
$range = new DateRange('2015-12-01', '2015-12-31');
```
or Pass array of date :

```php
$range = new DateRange(['2015-12-01', '2015-12-31']);
```

Not only string format but DateTime object is also accepted :

```php
$start = new DateTime('2012-12-01');
$end = new DateTime('2012-12-31');
$range = new DateRange([$start, $end]);
```

### access two date

DateRange has 2 date as DateTime object. and you can access with getter methods.

```php
# if you get start DateTime object.
$start = $range->getStart();

# if you get end DateTime object.
$end = $range->getEnd();
```

### contains

```php
## check contains specific date
var_dump($range->contains('2015-12-10'));
// bool(true)

var_dump($range->contains('2017-01-10'));
// bool(false)

```

### Period
If you use DateRange in foreach, you can get DatePeriod object through `getDatePeriod` like below:

```php
foreach($range->getDatePeriod() as $d) {
    echo $d->format('Y-m-d') . PHP_EOL;
}
// 2015-12-01
// 2015-12-02
// 2015-12-03
// 2015-12-04
// ...
// 2015-12-28
// 2015-12-29
// 2015-12-30
```

Default interval is set to `P1D`.
If you want to change interval, call `setInterval`

```php
## if you want to change interval, use setInterval()
$start = new DateTime('2012-12-01');
$end = new DateTime('2020-12-31');
$range = new DateRange([$start, $end]);
$range->setInterval(new DateInterval('P1Y')); // change from 'P1D' (Default)
foreach($range->getDatePeriod() as $d) {
    echo $d->format('Y-m-d') . PHP_EOL;
}
// 2012-12-01
// 2013-12-01
// 2014-12-01
// 2015-12-01
// 2016-12-01
// 2017-12-01
// 2018-12-01
// 2019-12-01
// 2020-12-01
```

## try demo

If you show demo, you have only to run `make demo`.

```bash
cd ./vendor/brtriver/date-range
make setup
make install
make demo
```

License
-------

DateRange is licensed under the MIT license.

