<?php

use Illuminate\Database\Eloquent\Model;

test('models extends base model')
    ->expect('Veeqtoh\SecureCode\Models')
    ->classes()
    ->toExtend(Model::class)
    ->ignoring('Veeqtoh\SecureCode\Models\Factories');

test('model factories extend the base factory class')
    ->expect('Veeqtoh\SecureCode\Models\Factories')
    ->classes()
    ->toExtend('Illuminate\Database\Eloquent\Factories\Factory');