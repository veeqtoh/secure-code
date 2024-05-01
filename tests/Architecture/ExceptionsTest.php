<?php

test('exceptions extend the base exception class')
    ->expect('Veeqtoh\DoorAccess\Exceptions')
    ->classes()
    ->toExtend(Exception::class);