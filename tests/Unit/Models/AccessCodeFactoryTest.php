<?php

namespace Veeqtoh\DoorAccess\Tests\Unit\Models\AccessCode;

use Veeqtoh\DoorAccess\Models\AccessCode;
use Veeqtoh\DoorAccess\Tests\Unit\TestCase;

final class AccessCodeFactoryTest extends TestCase
{
    public function test_that_the_access_code_model_factory_works_fine(): void
    {
        $accessCode = AccessCode::factory()->create();

        $deactivatedAccessCode = AccessCode::factory()->deactivated()->create();

        $inactiveAccessCode = AccessCode::factory()->inactive()->create();

        $this->assertDatabaseCount('access_codes', 3)
            ->assertModelExists($accessCode)
            ->assertModelExists($deactivatedAccessCode)
            ->assertModelExists($inactiveAccessCode);

        $this->assertTrue($accessCode->allocated_at !== null && $accessCode->reset_at == null);
        $this->assertTrue($deactivatedAccessCode->allocated_at !== null && $deactivatedAccessCode->reset_at !== null);
        $this->assertTrue($inactiveAccessCode->allocated_at == null && $inactiveAccessCode->reset_at == null);
    }
}