<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the database connection details for storing door access codes.
    |
    */

    'database' => [
        'connection' => env('DB_CONNECTION', 'sqlite'), // Change to your preferred database connection
        'table'      => 'door_access_codes', // Table name for storing codes
    ],

    /*
    |--------------------------------------------------------------------------
    | Code Generation Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the rules for generating secure door access codes.
    |
    */

    'generation' => [
        'code_length'              => 6, // The length of the generated code
        'character_repeated_limit' => 3, // The maximum number of times a character can be repeated
        'sequence_length_limit'    => 3, // The maximum sequence length allowed
        'unique_characters_limit'  => 3, // The minimum number of unique characters required
        'allowed_characters'       => '0123456789', // Allowed characters for code generation
    ],
];
