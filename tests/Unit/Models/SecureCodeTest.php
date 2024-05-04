<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Tests\Unit\Models\SecureCode;

use PHPUnit\Framework\Attributes\Test;
use Veeqtoh\SecureCode\Models\SecureCode;
use Veeqtoh\SecureCode\Tests\Unit\TestCase;

final class SecureCodeTest extends TestCase
{
    #[Test]
    public function connection_can_be_overridden(): void
    {
        config(['secure-code.connection' => 'custom']);

        $this->assertEquals(
            'custom',
            (new SecureCode())->getConnectionName(),
        );
    }

    #[Test]
    public function default_connection_is_used_if_the_override_is_not_set(): void
    {
        $this->assertNull((new SecureCode())->getConnectionName());
    }
}