<?php

test('globals')
    ->expect(['dd', 'ddd', 'die', 'dump', 'ray', 'sleep'])
    ->toBeUsedInNothing();

test('all classes use strict types')
    ->expect('Veeqtoh\SecureCode')
    ->toUseStrictTypes();