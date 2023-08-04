<?php
declare(strict_type=1);

namespace Veeqtoh\DoorAccess;

use Ramsey\Uuid\Uuid;

class CodeGenerator{

    /**
     * Generate a unique 6-digit code.
     *
     * @return string
     */
    public function generateCode(): string
    {
        $uuid = Uuid::uuid4();
        $code = preg_replace('/[^0-9]/', '', $uuid->toString());
        return substr($code, 0, 6);
    }
}