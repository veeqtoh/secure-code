<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes;

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;

/**
 * Class CodeGenerator
 * The library class that is used for generating unique, secure codes.
 *
 * @package Veeqtoh\DoorAccess\Classes
 */
class CodeGenerator
{
    use ConfigTrait;

    /**
     * CodeGenerator constructor.
     *
     * @param array $validators The validator classes to apply to code generation.
     */
    public function __construct(private array $validators = [])
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
            $code = $this->generateRandomCode($this->getCodeLength());
        } while (!$this->isCodeValid($code));

        return $code;
    }

    /**
     * Generate a random 6-digit code.
     *
     * @return string
     */
    private function generateRandomCode(int $length): string
    {
        $allowedCharacters = $this->getAllowedCharacters();

        if ($this->getCodeFormat() === 'numeric') {
            $min = (int) pow(10, $length - 1);
            $max = (int) pow(10, $length) - 1;

            return (string) random_int($min, $max);
        } else {
            // Handle other formats (e.g., alphanumeric, mixed characters).
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomIndex   = random_int(0, mb_strlen($allowedCharacters) - 1);
                $randomString .= $allowedCharacters[$randomIndex];
            }
            return $randomString;
        }
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
