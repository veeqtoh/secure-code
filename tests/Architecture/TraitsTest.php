<?php

test('traits directory contains only traits')
    ->expect('Veeqtoh\DoorAccess\Traits')
    ->toBeTraits();