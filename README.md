# secure-code

<p align="center">
<img src="https://victorukam.com/assets/images/secure-code.png" width="400">
</p>

<p align="center">
<a href="https://packagist.org/packages/veeqtoh/secure-code"><img src="https://img.shields.io/packagist/v/veeqtoh/secure-code.svg?style=flat-square" alt="Latest Version on Packagist"></a>
<a href="https://packagist.org/packages/veeqtoh/secure-code"><img src="https://img.shields.io/packagist/dt/veeqtoh/secure-code.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/veeqtoh/secure-code"><img src="https://img.shields.io/packagist/php-v/veeqtoh/secure-code?style=flat-square" alt="PHP from Packagist"></a>
<a href="https://github.com/veeqtoh/secure-code/blob/master/LICENSE"><img src="https://img.shields.io/github/license/veeqtoh/secure-code?style=flat-square" alt="GitHub license"></a>
</p>

## Table of Contents

- [Overview](#overview)
- [Installation](#installation)
    - [Requirements](#requirements)
    - [Install the Package](#install-the-package)
    - [Publish the Config and Migrations](#publish-the-config-and-migrations)
    - [Migrate the Database](#migrate-the-database)
- [Usage](#usage)
    - [Generating Secure Codes](#denerating-secure-codess)
        - [Quick Start](#quick-start)
        - [Validation](#validation)
        - [Defining your Custom Validation Class](#defining-your-custom-validation-classs)
        - [Customizing Configs](#customizing-configs)
        - [Using Custom Rules](#using-custom-rules)
        - [Facade](#facade)
    - [Using the Secure code Manager](#using-the-secure-code-manager)
        - [Allocating a Code](#allocating-a-code)
        - [Resetting a Code](#resetting-a-code)
        - [Destroying a Code](#destroying-a-code)
        - [Config Validation](#config-validation)
        - [Custom Database Connection](#custom-database-connection)
    - [Helper Methods](#helper-methods)
        - [Find by code](#find-by-code)
        - [Find by owner](#find-by-owner)
    - [Model Factories](#model-factories)
- [Testing](#testing)
- [Security](#security)
- [Contribution](#contribution)
- [Changelog](#changelog)
- [Upgrading](#upgrading)
- [License](#license)

# Overview

A Laravel package that provides secure codes management system, allowing you to generate n-digit secure codes and manage it's allocation within you existing web app.

## Installation


### Requirements

The package has been developed and tested to work with the following minimum requirements:

- PHP 8.x
- Laravel 11.x

Secure-code requires either the [BC Math](https://secure.php.net/manual/en/book.bc.php) or [GMP](https://secure.php.net/manual/en/book.gmp.php) PHP extensions in order to work.

### Install the Package

You can install the package via Composer:

```bash
composer require veeqtoh/secure-code
```

### Publish the Config and Migrations

You can then publish the package's config file and database migrations by using the following command:
```bash
php artisan vendor:publish --provider="Veeqtoh\SecureCode\Providers\SecureCodeProvider"
```

### Migrate the Database

This package contains a migration file that add a new table to the database: ``` secure_codes ```. To run this migration, simply run the following command:
```bash
php artisan migrate
```

## Usage

### Generating Secure Codes

#### Quick Start

The quickest way to get started with generating a secure code is by using the snippet below.
```php
use Veeqtoh\SecureCode\Classes\CodeGenerator;

$codeGenerator = new CodeGenerator();
$secureCode = $codeGenerator->generate();

echo "Generated code: $code";
```

#### Validation

By default, the secure code is not validated against any condition. The library however, comes with three (3) inbuilt validation classes that checks for;
1. Palindrome
2. Repeated characters
3. Sequence length
These validation classes can be initialized and passed down to the code generator class in an array on it's constructor as shown below;
```php
use Veeqtoh\SecureCode\Classes\CodeGenerator;

// Define specific validation rules.
$validators = [
    new NoPalindromeValidator(),
    new RepeatingCharactersValidator(),
    new MinimumUniqueCharactersValidator(),
  ];

// Generate a secure n-digit code
$codeGenerator = new CodeGenerator();
$secureCode = $codeGenerator->generate();

echo "Generated code: $code";
```
You may wish to define a custom validation yourself for more control. You can

#### Custom Validation

To achieve this, you must write a class that implements the library's base validation interface as follows;

##### Defining your custom validation class

```php
declare(strict_types=1);

namespace Your\Custom\Class\Namespace;

use Veeqtoh\SecureCode\Contracts\CodeValidator;

class YourCustomValidatorValidator implements CodeValidator
{

  public function isValid(string $code): bool
  {
      return 'your custom rule';
  }

}
```
To use your custom rule, simply initialize and include it in the validators array as shown above.

#### Customizing Configs

Tailor the package to to your needs with customizable configuration options:

- Database Connection: Specify a custom database connection if needed.
- Code Generation Rules: Define code length and constraints like character repetition and unique characters limit.
- Code Format: Choose from numeric, alphanumeric, or mixed formats for generated codes.
- Code Characters: Customize character sets for different code formats.
- Config Validation: Optionally validate configuration for safety.
- Eloquent Factories: Define factories for testing purposes.
With these options, you can configure the system to align with your security standards and requirements.

Note: The code length cannot be more than 19.

#### Facade

If you prefer to use facades in Laravel, you can choose to use the provided ``` SecureCode ``` facade instead of instantiating
the ``` CodeGenerator ``` class manually.


### Using the Secure Code Manager

The code manager provides functionality to manage generated access codes, including allocation, resetting, and destruction.

#### Allocating a Code

To allocate a code to an owner, you can use the allocateCode method:

```php
use Veeqtoh\DoorAccess\Classes\CodeManager;

$manager = new CodeManager();
$code = $manager->allocateCode('generated-code', 'owner-id');

echo "Allocated code: $code";
```

#### Resetting a Code

To reset a code and make it available for reallocation, you can use the resetCode method:

```php
use Veeqtoh\DoorAccess\Classes\CodeManager;

$manager = new CodeManager();
$success = $manager->resetCode('allocated-code');

if ($success) {
    echo "Code reset successfully";
} else {
    echo "Failed to reset code";
}

```

#### Destroying a Code

To permanently destroy a code, you can use the destroyCode method:

```php
use Veeqtoh\DoorAccess\Classes\CodeManager;

$manager = new CodeManager();
$success = $manager->destroyCode('code-to-destroy');

if ($success) {
    echo "Code destroyed successfully";
} else {
    echo "Failed to destroy code";
}

```

#### Custom Database Connection

By default, Secure code will use your application's default database connection. But there may be times that you'd like to use a different connection. For example, you might be building a multi-tenant application that uses a separate connection for each tenant, and you may want to store the Secure codes in a central database.

To do this, you can set the connection name using the `connection` config value in the `config/secure-code.php` file like so:

```
'connection' => 'custom_database_connection_name',
```


### Helper Methods

#### Find by code
To find the SecureCode model that corresponds to a given code, you can use the ``` ->findByCode() ``` method.

For example, to find the SecureCode model of a code that has the code ``` abc123 ```, you could use the following:

```php
$secureCode = \Veeqtoh\SecureCode\Models\SecureCode::findByCode('abc123');
``` 

#### Find by Owner

To find the SecureCode models that belongs to a given owner ID, you can use the ``` ->findByOwnerId() ``` method.

For example, to find all of the SecureCode models of owners that belongs to ``` john doe ```, you could use
the following:

```php
$secureCodes = \Veeqtoh\SecureCode\Models\SecureCode::findByOwnerId('john doe');
```

### Model Factories

The package comes with model factories included for testing purposes.

```php
use Veeqtoh\SecureCode\Models\SecureCode;

```

## Testing

To run the package's unit tests, run the following command:

``` bash
vendor/bin/pest
```

## Security

If you find any security related issues, please contact me directly at [victorjohnukam@gmail.com](mailto:victorjohnukam@gmail.com) to report it.

## Contribution

If you wish to make any changes or improvements to the package, feel free to make a pull request.

Note: A contribution guide will be added soon.

## Changelog

Check the [CHANGELOG](CHANGELOG.md) to get more information about the latest changes.

## Upgrading

Check the [UPGRADE](UPGRADE.md) guide to get more information on how to update this library to newer versions.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support Me

If you've found this package useful, please consider sponsoring this project. It will encourage me to keep maintaining it.
