# door-access
Generate random access code unique to team members.

## Installation
This project using composer.
```
$ composer require veeqtoh/door-access
```

## Usage
Generate door access code.
```php
<?php

use Veeqtoh\DoorAccess;

$access_code = new DoorAccess(10);
echo $access_code->generate();
```