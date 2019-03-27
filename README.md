# PHP Messenger

## Description

PHP Messenger provides a suite of routine which can be used in CLI based applications, providing a simple consistent interface, taking care of all the colorizing for you.

![Screenshot](https://github.com/mikeerickson/php-messenger/blob/master/docs/messenger-example.png)

#### Using with Laravel Commands and Laravel-Zero
In addition, PHP Messenger can also be used with CLI applications created with Laravel Commands or Laravel-Zero, using the Laravel facades interface.

## Installation

```bash
composer require codedungeon/php-messenger
```

## Laravel Configuration

#### Laravel before 5.5 registration

- Registering Service Provider

	Modify `config/app.php` and add the Service Provide
	
	```php
	   'providers' => [
            ...
			Codedungeon\PHPMessenger\MessengerServiceProvider::class,
			...
	```
	
- Registering Facades

	Modify `config/app/php` and add the Facades to the `aliases` section
	
	```php
	    'aliases' => [
    	...
            'Messenger' => Codedungeon\PHPMessenger\MessengerServiceProvider::class,
		...
	```

#### Laravel 5.5 and greater
When installing into a Laravel based project, it will use the auto discover system available with Laravel 5.5 or greater.

## Laravel Zero Configuration

- Register Service Provider

	Modify config/app.php `providers` section
	
	```php
		'providers' => [
			...
			Codedungeon\PHPMessenger\ServiceProvider::class,
			...
		],
	```
- Create desired command, and use as follows

	```php
		// add use statement
		use Codedungeon\PHPMessenger\Facades\Messenger;

		// handle method
		public function handle()
		{
			echo PHP_EOL;
			$msg = "PHP Messenger v" . Messenger::version();
			Messenger::important($msg);
			Messenger::info("-- Using Laravel Package (Facades)");
		   ...
		}
	```

## Using in non-Laravel applications

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Codedungeon\PHPMessenger\Messenger;

$messenger = new Messenger();

$messenger->success("Success Message w/ Label"," SUCCESS ");
$messenger->info("Information Message");
...

```


## Usage

#### Messenger Signature

All messenger methods use the same method signature as follows

| Parameter | Type   | Description                                                                          |
|-----------|--------|--------------------------------------------------------------------------------------|
| message   | string | Desired message to display in console                                                |
| label     | string | Optional label message, if supplied the label will appear first, followed by message |


#### Messenger Methods

```php
Messenger::log(msg:string, [label:string - optional])

Messenger::info(msg:string, [label:string - optional])

Messenger::debug(msg:string, [label:string - optional])

Messenger::critical(msg:string, [label:string - optional])

Messenger::error(msg:string, [label:string - optional])

Messenger::success(msg:string, [label:string - optional])

Messenger::warning(msg:string, [label:string - optional])

Messenger::warn(msg:string, [label:string - optional])

Messenger::important(msg:string, [label:string - optional])

Messenger::status(msg:string, [label:string - optional])

Messenger::notice(msg:string, [label:string - optional])

Messenger::note(msg:string, [label:string - optional])

Messenger::version() -> returns current package version

```

### License

Copyright &copy; 2019 Mike Erickson
Released under the MIT license

## Credits

PHP Messenger written by Mike Erickson

E-Mail: [codedungeon@gmail.com](mailto:codedungeon@gmail.com)

Twitter: [@codedungeon](http://twitter.com/codedungeon)

Website: [codedungeon.io](http://codedungeon.io)