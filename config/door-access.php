<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Database Connection
    |--------------------------------------------------------------------------
    |
    | This configuration value is used to override the database connection
    | that will be used by models of this package. If set to `null`, your
    | application's default database connection will be used.
    |
    */
    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Code Generation Rules
    |--------------------------------------------------------------------------
    |
    | These are the default rules for generating secure door access codes.
    | You can customize these rules in the configuration file to meet your needs.
    |
    */

    'code_length'              => 6,
    'character_repeated_limit' => 3,
    'sequence_length_limit'    => 3,
    'unique_characters_limit'  => 3,
    'allowed_characters'       => '0123456789',

    /*
    |--------------------------------------------------------------------------
    | Eloquent Factories
    |--------------------------------------------------------------------------
    |
    | Define eloquent factories that you will use for your testing purposes.
    |
    */
    'factories' => [
        \Veeqtoh\DoorAccess\Models\AccessCode::class => \Veeqtoh\DoorAccess\Models\Factories\AccessCodeFactory::class,
    ],
];
