<?php

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;
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

test('config trait is a trait')
    ->expect('Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait')
    ->classes()
    ->toBeTraits();

test('code generator uses config trait')
    ->expect('Veeqtoh\DoorAccess\Classes\CodeGenerator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('minimum unique characters validator uses config trait')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\MinimumUniqueCharactersValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('no palindrome validator validator uses config trait')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\NoPalindromeValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('repeating characters validator validator uses config trait')
    ->expect('Veeqtoh\DoorAccess\Classes\Validators\RepeatingCharactersValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);