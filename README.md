# door-access
Generate random access codes unique to team members for a secure door access system.

## Installation
This project uses Composer for easy installation:
```
$ composer require veeqtoh/door-access
```

## Requirements
* PHP version ^8.1.10
* Laravel framework ^8.0 (if using within a Laravel application)

## Configuration
The package provides flexibility for code generation rules. You can customize the code generation process by modifying the rules in the `config/rules.php` file.

## Database Setup
To store access codes and manage allocations, you need to set up the database and run the migration provided by the package. Use the following commands:
```
$ php artisan migrate
```

## Usage
Generate a door access code using the `CodeGenerator` class:
```php
<?php

use Veeqtoh\DoorAccess\CodeGenerator;

$codeGenerator = new CodeGenerator();
$accessCode = $codeGenerator->generateCode();
```

## Database Management
The CodeManager class provides methods for allocating and resetting access codes. It uses the database to store and manage code allocations. Use it as follows:
```php
<?php

use Veeqtoh\DoorAccess\CodeManager;

$manager = new CodeManager();

// Allocate a code to a team member
$teamMemberId = 'team_member_1';
$accessCode = $manager->allocateCode($teamMemberId);

// Reset a code and make it available for reallocation
$code = '123456'; // Existing code to reset
$resetSuccess = $manager->resetCode($code);
```

## Testing
To run the unit tests for the package, use PHPUnit:
```
$ phpunit
```

## Contributing

Contributions are'nt welcome at this time as this is a private project. If you'd like to contribute to the project, please reachout to me by mail [victorjohnukam@gmail.com](victorjohnukam@gmail.com).

## Security

When using the package in a production environment, make sure to follow security best practices and protect sensitive data.

## License

This package is open-source and released under the MIT License.