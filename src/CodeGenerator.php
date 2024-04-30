<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess;

/**
 * Class CodeGenerator
 * The library class that is used for generating unique, secure codes.
 *
 * @package Veeqtoh\DoorAccess
 */
class CodeGenerator
{
    /**
     * CodeGenerator constructor.
     *
     * @param array $validators The validator classes to apply to code generation.
     */
    public function __construct(private array $validators)
    {
        //
    }

    /**
     * Generate a unique 6-digit code.
     *
     * @return string|null The generated code or null if code generation fails.
     */
    public function generateCode(): ?string
    {
        do {
            $code = $this->generateRandomCode();
        } while (!$this->isCodeValid($code));

        return $code;
    }

    /**
     * Generate a random 6-digit code.
     *
     * @return string
     */
    private function generateRandomCode(): string
    {
        return (string) random_int(100000, 999999);
    }

    /**
     * Check if the generated code is valid according to the constraints.
     *
     * @param string $code
     *
     * @return bool
     */
    private function isCodeValid(string $code): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($code)) {
              return false;
            }
          }
          return true;
    }

}
