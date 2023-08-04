<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Code Generation Rules
    |--------------------------------------------------------------------------
    |
    | These are the default rules for generating secure door access codes.
    | You can customize these rules in the configuration file to meet your needs.
    |
    */

    'code_length' => 6,
    'character_repeated_limit' => 3,
    'sequence_length_limit' => 3,
    'unique_characters_limit' => 3,
    'allowed_characters' => '0123456789',
];
