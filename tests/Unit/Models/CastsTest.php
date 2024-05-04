<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Tests\Unit\Models\SecureCode;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Veeqtoh\SecureCode\Models\SecureCode;
use Veeqtoh\SecureCode\Tests\Unit\TestCase;

final class CastsTest extends TestCase
{
    #[Test]
    public function carbon_date_objects_are_returned(): void
    {
        $secureCode = SecureCode::factory()
            ->create([
                'allocated_at' => now(),
                'reset_at'     => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

        $secureCode->refresh();

        $this->assertInstanceOf(Carbon::class, $secureCode->allocated_at);
        $this->assertInstanceOf(Carbon::class, $secureCode->reset_at);
        $this->assertInstanceOf(Carbon::class, $secureCode->created_at);
        $this->assertInstanceOf(Carbon::class, $secureCode->updated_at);
    }
}