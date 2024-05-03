<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Tests\Unit\Models\AccessCode;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Veeqtoh\DoorAccess\Models\AccessCode;
use Veeqtoh\DoorAccess\Tests\Unit\TestCase;

final class CastsTest extends TestCase
{
    #[Test]
    public function carbon_date_objects_are_returned(): void
    {
        $accessCode = AccessCode::factory()
            ->create([
                'allocated_at' => now(),
                'reset_at'     => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

        $accessCode->refresh();

        $this->assertInstanceOf(Carbon::class, $accessCode->allocated_at);
        $this->assertInstanceOf(Carbon::class, $accessCode->reset_at);
        $this->assertInstanceOf(Carbon::class, $accessCode->created_at);
        $this->assertInstanceOf(Carbon::class, $accessCode->updated_at);
    }
}