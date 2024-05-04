<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes;

use Illuminate\Support\Facades\Log;
use Veeqtoh\SecureCode\Classes\Traits\ConfigTrait;
use Veeqtoh\SecureCode\Exceptions\InvalidCodeException;
use Veeqtoh\SecureCode\Models\SecureCode;

/**
 * Class CodeManager
 * This class is used for managing generated codes.
 *
 * @package Veeqtoh\SecureCode\Classes
 */
class CodeManager
{
    use ConfigTrait;

    /**
     * Save the secure code in the database.
     *
     * @param string $code The secure code to be saved.
     *
     * @return secureCode The newly created secureCode model.
     */
    public function saveCode(string $code): ?secureCode
    {
        return SecureCode::create(['code' => $code]);
    }

    /**
     * Allocate a code to an owner.
     *
     * @param string $code    The generated code to be allocated.
     * @param string $ownerId The owner to be allocated the code.
     *
     * @return secureCode The secureCode model with the new allocation.
     */
    public function allocateCode(string $code, string $ownerId): secureCode
    {
        $existingCode = SecureCode::whereCode($code)->first();

        if ($existingCode) {
            if ($existingCode->isAllocated()) {
                $existingCode->reset();
            }

            return $existingCode->allocate($ownerId);
        }

        return SecureCode::create([
            'code'     => $code,
            'owner_id' => $ownerId
        ]);
    }

    /**
     * Reset a code and make it available for reallocation.
     *
     * @param string $code,
     *
     * @return secureCode The secureCode model with the new allocation.
     *
     * @throws InvalidCodeException When code to be reset is not found.
     */
    public function resetCode(string $code): secureCode
    {
        $existingCode = SecureCode::whereCode($code)->first();

        if (!$existingCode) {
            Log::error("The code ({$code}) you are trying to reset does not exist");
            throw new InvalidCodeException("The code ({$code}) you are trying to reset does not exist", 1);
        }

        return $existingCode->reset();
    }

    /**
     * Destroy the secure code in the database.
     *
     * @param string $code The secure code to be destroyed.
     *
     * @return bool Returns true if the secure code was successfully destroyed, false otherwise.
     */
    public function destroyCode(string $code): bool
    {
        $existingCode = SecureCode::whereCode($code)->first();

        if (!$existingCode) {
            Log::error("The code ({$code}) you are trying to destroy does not exist");
            throw new InvalidCodeException("The code ({$code}) you are trying to destroy does not exist", 1);
        }

        return $existingCode->delete();
    }
}
