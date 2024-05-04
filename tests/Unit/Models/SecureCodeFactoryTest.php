<?php

namespace Veeqtoh\SecureCode\Tests\Unit\Models\SecureCode;

use Veeqtoh\SecureCode\Models\SecureCode;
use Veeqtoh\SecureCode\Tests\Unit\TestCase;

final class SecureCodeFactoryTest extends TestCase
{
    public function test_that_the_secure_code_model_factory_works_fine(): void
    {
        $secureCode = SecureCode::factory()->create();

        $deactivatedSecureCode = SecureCode::factory()->deactivated()->create();

        $inactiveSecureCode = SecureCode::factory()->inactive()->create();

        $this->assertDatabaseCount('secure_codes', 3)
            ->assertModelExists($secureCode)
            ->assertModelExists($deactivatedSecureCode)
            ->assertModelExists($inactiveSecureCode);

        $this->assertTrue($secureCode->allocated_at !== null && $secureCode->reset_at == null);
        $this->assertTrue($deactivatedSecureCode->allocated_at !== null && $deactivatedSecureCode->reset_at !== null);
        $this->assertTrue($inactiveSecureCode->allocated_at == null && $inactiveSecureCode->reset_at == null);
    }
}