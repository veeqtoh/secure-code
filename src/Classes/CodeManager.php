<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes;

use Illuminate\Support\Facades\Log;
use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;
use Veeqtoh\DoorAccess\Exceptions\InvalidCodeException;
use Veeqtoh\DoorAccess\Models\AccessCode;

/**
 * Class CodeManager
 * This class is used for managing generated codes.
 *
 * @package Veeqtoh\DoorAccess\Classes
 */
class CodeManager
{
    use ConfigTrait;

    /**
     * Save the access code in the database.
     *
     * @param string $code The access code to be saved.
     *
     * @return AccessCode The newly created AccessCode model.
     */
    public function saveCode(string $code): ?AccessCode
    {
        return AccessCode::create(['code' => $code]);
    }

    /**
     * Allocate a code to an owner.
     *
     * @param string $code    The generated code to be allocated.
     * @param string $ownerId The owner to be allocated the code.
     *
     * @return AccessCode The AccessCode model with the new allocation.
     */
    public function allocateCode(string $code, string $ownerId): AccessCode
    {
        $existingCode = AccessCode::whereCode($code)->first();

        if ($existingCode) {
            if ($existingCode->isAllocated()) {
                $existingCode->reset();
            }

            return $existingCode->allocate($ownerId);
        }

        return AccessCode::create([
            'code'     => $code,
            'owner_id' => $ownerId
        ]);
    }

    /**
     * Reset a code and make it available for reallocation.
     *
     * @param string $code,
     *
     * @return AccessCode The AccessCode model with the new allocation.
     *
     * @throws InvalidCodeException When code to be reset is not found.
     */
    public function resetCode(string $code): AccessCode
    {
        $existingCode = AccessCode::whereCode($code)->first();

        if (!$existingCode) {
            Log::error("The code ({$code}) you are trying to reset does not exist");
            throw new InvalidCodeException("The code ({$code}) you are trying to reset does not exist", 1);
        }

        return $existingCode->reset();
    }

    /**
     * Destroy the access code in the database.
     *
     * @param string $code The access code to be destroyed.
     *
     * @return bool Returns true if the access code was successfully destroyed, false otherwise.
     */
    public function destroyCode(string $code): bool
    {
        $existingCode = AccessCode::whereCode($code)->first();

        if (!$existingCode) {
            Log::error("The code ({$code}) you are trying to destroy does not exist");
            throw new InvalidCodeException("The code ({$code}) you are trying to destroy does not exist", 1);
        }

        return $existingCode->delete();
    }
}
