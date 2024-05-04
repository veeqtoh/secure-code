<?php

test('exceptions extend the base exception class')
    ->expect('Veeqtoh\SecureCode\Exceptions')
    ->classes()
    ->toExtend(Exception::class);