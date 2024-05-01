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
    | NOTE: Maximum code length is 19.
    |
    */

    'code_length'              => 6,
    'character_repeated_limit' => 3,
    'sequence_length_limit'    => 3,
    'unique_characters_limit'  => 3,

    /*
    |--------------------------------------------------------------------------
    | Code format
    |--------------------------------------------------------------------------
    |
    | Define the format of the code. The options are
    | 'numeric', 'alphanumeric' or 'mixed'.
    | The default for numeric format is '0123456789'.
    |
    */

    'code_format' => 'mixed',

    /*
    |--------------------------------------------------------------------------
    | Code characters
    |--------------------------------------------------------------------------
    |
    | Define the characters of the generated code.
    | The code generator dynamically selects the appropriate
    | character set depending on the chosen code format.
    |
    */

    'numeric_characters'      => '0123456789', // Default for numeric format.
    'alphanumeric_characters' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'mixed_characters'        => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{};:<>,.?/',

    /*
    |--------------------------------------------------------------------------
    | Config Validation
    |--------------------------------------------------------------------------
    |
    | Choose whether you want the config to be validated. This
    | can be useful for ensuring that your config values are
    | safe to use.
    |
    */

    'validate_config' => true,

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
