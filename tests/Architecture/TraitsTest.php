<?php

test('traits directory contains only traits')
    ->expect('Veeqtoh\SecureCode\Traits')
    ->toBeTraits();