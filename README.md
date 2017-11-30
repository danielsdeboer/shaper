[![Build Status](https://travis-ci.org/danielsdeboer/shaper.svg?branch=master)](https://travis-ci.org/danielsdeboer/shaper)
[![Latest Stable Version](https://poser.pugx.org/aviator/shaper/v/stable)](https://packagist.org/packages/aviator/shaper)
[![License](https://poser.pugx.org/aviator/shaper/license)](https://packagist.org/packages/aviator/shaper)

## Overview

Shaper provides an interface and abstract classes which can be extended to create array or collection shaper classes. These classes can then be reused to shape the same sort of iterable, eg when preparing for serialization.

### Installation

Via Composer:

```
composer require aviator/shaper
```

### Testing

Via Composer:

```
composer test
```

### Usage

Extend either the collection or array shaper and define a public method called `shaper()`:

```php
public function shaper ($item)
{
    return [
        'mutated_name' => ucfirst($item['name')
    ];
}
```

This callback can do whatever you like. Once you've defined your class, you can instantiate it and call `shape()`, which maps over your iterable and applies the callback:

```php
$shaper = new MyArrayShaper($array);
$shaped = $shaper->shape();
```

You can also set the iterable after instantiation:

```php
$shaper = new MyArrayShaper();

// Returns null
$shaper->get();

$shaper->set($yourArray);

// Returns the array
$shaper->get(); 
```

## Other

### License

This package is licensed with the [MIT License (MIT)](LICENSE).

