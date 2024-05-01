<?php

use Illuminate\Database\Eloquent\Model;

test('models extends base model')
    ->expect('Veeqtoh\DoorAccess\Models')
    ->classes()
    ->toExtend(Model::class)
    ->ignoring('Veeqtoh\DoorAccess\Models\Factories');

test('model factories extend the base factory class')
    ->expect('Veeqtoh\DoorAccess\Models\Factories')
    ->classes()
    ->toExtend('Illuminate\Database\Eloquent\Factories\Factory');