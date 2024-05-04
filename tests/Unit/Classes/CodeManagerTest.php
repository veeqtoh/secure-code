<?php

namespace Veeqtoh\DoorAccess\Tests\Unit\Classes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Veeqtoh\DoorAccess\Classes\CodeManager;
use Veeqtoh\DoorAccess\Exceptions\InvalidCodeException;
use Veeqtoh\DoorAccess\Models\AccessCode;
use Veeqtoh\DoorAccess\Tests\Unit\TestCase;

class CodeManagerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function testSaveCode(): void
    {
        $codeManager = new CodeManager();
        $code = '123456';
        $accessCode = $codeManager->saveCode($code);

        $this->assertInstanceOf(AccessCode::class, $accessCode);
        $this->assertEquals($code, $accessCode->code);
    }

    #[Test]
    public function testAllocateCode(): void
    {
        AccessCode::factory()->create(['code' => '123456', 'owner_id' => null]);

        $codeManager = new CodeManager();
        $ownerId = 'user_123';
        $accessCode = $codeManager->allocateCode('123456', $ownerId);

        $this->assertInstanceOf(AccessCode::class, $accessCode);
        $this->assertEquals($ownerId, $accessCode->owner_id);
    }

    public function testResetCode(): void
    {
        AccessCode::factory()->create(['code' => '123456']);

        $codeManager = new CodeManager();
        $code = '123456';
        $result = $codeManager->resetCode($code);

        $this->assertNull(AccessCode::where('code', $code)->first()->owner_id);
    }

    public function testResetCodeWithNonExistingCode(): void
    {
        Log::shouldReceive('error')->once();
        $this->expectException(InvalidCodeException::class);
        $codeManager = new CodeManager();
        $code = 'non_existing_code';
        $codeManager->resetCode($code);
    }

    public function testDestroyCode(): void
    {
        AccessCode::factory()->create(['code' => '123456']);

        $codeManager = new CodeManager();
        $code = '123456';
        $result = $codeManager->destroyCode($code);

        $this->assertTrue($result);
        $this->assertNull(AccessCode::where('code', $code)->first());
    }

    public function testDestroyCodeNonExistingCode(): void
    {
        Log::shouldReceive('error')->once();
        $this->expectException(InvalidCodeException::class);
        $codeManager = new CodeManager();
        $code = 'non_existing_code';
        $codeManager->destroyCode($code);
    }
}
