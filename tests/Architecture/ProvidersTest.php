<?php

test('providers extend the base provider class')
    ->expect('Veeqtoh\SecureCode\Providers')
    ->classes()
    ->toExtend(\Illuminate\Support\ServiceProvider::class);