<?php

test('providers extend the base provider class')
    ->expect('Veeqtoh\DoorAccess\Providers')
    ->classes()
    ->toExtend(\Illuminate\Support\ServiceProvider::class);