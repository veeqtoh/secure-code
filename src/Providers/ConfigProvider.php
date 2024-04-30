<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Providers;

use Illuminate\Support\Facades\Config;

/**
 * Class ConfigProvider
 * @package Veeqtoh\DoorAccess
 */
class ConfigProvider
{
    /**
     * Get the rules for validating characters in the access code to be generated.
     *
     * @return array An array containing the following rules:
     * - 'allowed_characters' (string): A string containing the characters that are allowed.
     * - 'character_repeated_limit' (int): The maximum number of times a character can be repeated consecutively.
     * - 'sequence_length_limit' (int): The maximum length of a character sequence allowed.
     * - 'unique_characters_limit' (int): The maximum number of unique characters allowed in the string.
     */
    public function getRules(): array
    {
        // Load the rules from the configuration file
        $defaultRules = include 'Config/rules.php';

        // Load rules from Config/rules.php file, if available
        $rules = Config::get('door-access.rules') ?? [];

        // Replace the default rules with the rules from Config/rules.php, if available
        return array_replace($defaultRules, $rules);
    }
}
