<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Tests\Unit\Models\AccessCode;

use PHPUnit\Framework\Attributes\Test;
use Veeqtoh\DoorAccess\Models\AccessCode;
use Veeqtoh\DoorAccess\Tests\Unit\TestCase;

final class AccessCodeTest extends TestCase
{
    #[Test]
    public function connection_can_be_overridden(): void
    {
        config(['door-access.connection' => 'custom']);

        $this->assertEquals(
            'custom',
            (new AccessCode())->getConnectionName(),
        );
    }

    #[Test]
    public function default_connection_is_used_if_the_override_is_not_set(): void
    {
        $this->assertNull((new AccessCode())->getConnectionName());
    }
}