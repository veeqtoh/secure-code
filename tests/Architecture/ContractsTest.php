<?php

test('contracts directory contains only contracts')
    ->expect('Veeqtoh\DoorAccess\contracts')
    ->toBeInterfaces();