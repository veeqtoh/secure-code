<?php

test('contracts directory contains only contracts')
    ->expect('Veeqtoh\SecureCode\contracts')
    ->toBeInterfaces();