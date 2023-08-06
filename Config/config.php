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
];
