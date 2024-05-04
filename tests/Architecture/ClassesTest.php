<?php

use Veeqtoh\SecureCode\Classes\Traits\ConfigTrait;
use Veeqtoh\SecureCode\Contracts\CodeValidator;

test('minimum unique characters validator implements the validator interface')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\MinimumUniqueCharactersValidator')
    ->classes()
    ->toImplement(CodeValidator::class);

test('no palindrome validator implements the validator interface')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\NoPalindromeValidator')
    ->classes()
    ->toImplement(CodeValidator::class);

test('repeating characters validator implements the validator interface')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\RepeatingCharactersValidator')
    ->classes()
    ->toImplement(CodeValidator::class);

test('config trait is a trait')
    ->expect('Veeqtoh\SecureCode\Classes\Traits\ConfigTrait')
    ->classes()
    ->toBeTraits();

test('code generator uses config trait')
    ->expect('Veeqtoh\SecureCode\Classes\CodeGenerator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('minimum unique characters validator uses config trait')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\MinimumUniqueCharactersValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('no palindrome validator validator uses config trait')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\NoPalindromeValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);

test('repeating characters validator validator uses config trait')
    ->expect('Veeqtoh\SecureCode\Classes\Validators\RepeatingCharactersValidator')
    ->traits()
    ->toExtend(ConfigTrait::class);