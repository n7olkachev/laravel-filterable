# Laravel Filterable Trait

<p align="center">
<a href="https://websecret.by"><img src="https://websecret.by/images/logo-github.png" /></a>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/n7olkachev/laravel-filterable.svg?style=flat-square)](https://packagist.org/packages/n7olkachev/laravel-filterable)
[![Licence](https://img.shields.io/packagist/l/n7olkachev/laravel-filterable.svg?style=flat-square)](https://packagist.org/packages/n7olkachev/laravel-filterable)
[![Build Status](https://travis-ci.org/n7olkachev/laravel-filterable.svg?branch=master)](https://travis-ci.org/n7olkachev/laravel-filterable)

## Why?

This package is powered by standard Laravel scopes, instead of other similar packages, 
that brings something like `Filter` classes to your code, so it is much more easy to jump into.
Also, if you decide to remove this package from your project, you will stay with standard scopes
which can be used directly further.

Personally, I use this trait for faster development, combining it with `$request->all()`
 
```php
Page::filter($request->all())->get()
```

By default, you get equality filters (`where field = bar`) 
and when you need to support other queries, adding scope will 
do the trick. See examples for better understanding.

## Examples

```php
class Page extends Model
{
    use Filterable;

    protected $fillable = [
        'title',
        'status',
        'created_at',
    ];

    public function scopeCreatedAfter($query, $time)
    {
        return $query->where('created_at', '>', $time);
    }
}
```

Now, we can use `filter` scope to filter our queries:

```php
Page::filter(['title' => 'Cool page'])->first(); // equals to where('title', 'Cool page')

Page::filter(['status' => ['new', 'active'])->get() // equals to whereIn('status', ['new', 'active'])

Page::filter(['created_after' => '2017-01-01'])->get() // equals to createdAfter('2017-01-01') (notice our scope in Page class)
```

Of course it supports filters with multiple keys:
 
 ```php
Page::filter(['title' => 'Cool page', 'status' => 'active'])->first()
 ```

## Installation

You can install the package via composer:

``` bash
composer require n7olkachev/laravel-filterable
```

Next, add Filterable trait to your models:

```php
use Filterable;
```

That's all!

## Testing

``` bash
$ composer test
```

## Credits

- [Nikita Tolkachev](https://github.com/n7olkachev)

## Sponsored by

https://websecret.by/

Web agency based in Minsk, Belarus

## License

The MIT License (MIT)
