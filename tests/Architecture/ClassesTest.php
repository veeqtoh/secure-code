<?php

use Veeqtoh\DoorAccess\Contracts\CodeValidator;

test('minimum unique characters validator implements the validator interface')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\MinimumUniqueCharactersValidator')
    ->classes()
    ->toImplement(CodeValidator::class);

test('no palindrome validator implements the validator interface')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\NoPalindromeValidator')
    ->classes()
    ->toImplement(CodeValidator::class);

test('repeating characters validator implements the validator interface')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\RepeatingCharactersValidator')
    ->classes()
    ->toImplement(CodeValidator::class);