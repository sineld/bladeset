## Laravel 5 Blade Variable Assign In Template

This package is heavily inspirated from [alexdover/blade-set](https://github.com/alexdover/blade-set) after [this discussion](https://github.com/laravel/framework/issues/4778).

A very simple blade extension which allows variables to be set within blade templates.

This version is for Laravel 5.6 and should work with latest version of Laravel, if don't please mail me.

See master branch for latest release of Laravel.

### Usage Examples

```php
@set('myVariable', $existing_variable)

// or

@set("myVariable", "Hello, World!")
```

Then you can use the variable `$myVariable` in the blade template.

```php
{{ $myVariable }}
```

You might choose to fetch a bunch of models from your template, for example

```php
@set('myModelList', MyModel::where('something', '=', 1)->paginate(10))
```

### Available Operators [set, var, assign]

```php
@set('username', 'sineld')

@var("username", "sineld")

@assign('username', 'sineld')
```

Tip: You can assign your own operator in config file!

### Why?

Compare

```php
<?php $myModelList = MyModel::where('something', '=', 1)->paginate(10); ?>
```

to

```php
@set('myModelList', MyModel::where('something', '=', 1)->paginate(10))
```

I felt that the use of the `@set` was a more elegant solution in the context of blade templates.

**Another reason (from [github issue page](https://github.com/laravel/framework/issues/4778#issuecomment-126774099)):**

An example where setting and keeping track of a variable inside a template using this sytax would be processing a list of things where each thing has a week and you want to set a week header for each group of weeks:

```php
@set('week', 0);

@foreach ($things as $thing)
  @if ($week != $thing->week)
    WEEK {{ $thing->week }}
    @set('week', $thing->week)
  @endif

  Title: {{ $thing->title }}
@endforeach
```

### Installation

Run this command on terminal in your packages root:

```php
composer require sineld/bladeset
```

or

Require this package in your `composer.json`:

```php
"sineld/bladeset": "5.6"
```

Update composer. This will download the package.

```php
composer update
```

Add the BladeSetServiceProvider to the providers array in `config/app.php` if your projects Laravel version is below 5.5. If you Laravel version is higher or equal to 5.5 you do not need to add the line below to `config/app.php` file because package auto discovery is available.

```php
Sineld\BladeSet\BladeSetServiceProvider::class,
```

(Optional) Publish package config.

```php
php artisan vendor:publish
```

Then edit `app/config/bladeset.php` accoring to your needs.


All done!

### Licence
 
You can use this package under the [MIT license](http://opensource.org/licenses/MIT)

### Feedback

If you have any questions, feature requests or constructive criticism then please get in touch.

Twitter - [@sineld](http://twitter.com/sineld)
