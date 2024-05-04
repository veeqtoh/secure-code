<?php

namespace Veeqtoh\SecureCode\Tests\Unit\Classes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Veeqtoh\SecureCode\Classes\CodeManager;
use Veeqtoh\SecureCode\Exceptions\InvalidCodeException;
use Veeqtoh\SecureCode\Models\SecureCode;
use Veeqtoh\SecureCode\Tests\Unit\TestCase;

class CodeManagerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function testSaveCode(): void
    {
        $codeManager = new CodeManager();
        $code = '123456';
        $secureCode = $codeManager->saveCode($code);

        $this->assertInstanceOf(SecureCode::class, $secureCode);
        $this->assertEquals($code, $secureCode->code);
    }

    #[Test]
    public function testAllocateCode(): void
    {
        SecureCode::factory()->create(['code' => '123456', 'owner_id' => null]);

        $codeManager = new CodeManager();
        $ownerId = 'user_123';
        $secureCode = $codeManager->allocateCode('123456', $ownerId);

        $this->assertInstanceOf(SecureCode::class, $secureCode);
        $this->assertEquals($ownerId, $secureCode->owner_id);
    }

    public function testResetCode(): void
    {
        SecureCode::factory()->create(['code' => '123456']);

        $codeManager = new CodeManager();
        $code = '123456';
        $result = $codeManager->resetCode($code);

        $this->assertNull(SecureCode::where('code', $code)->first()->owner_id);
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
        SecureCode::factory()->create(['code' => '123456']);

        $codeManager = new CodeManager();
        $code = '123456';
        $result = $codeManager->destroyCode($code);

        $this->assertTrue($result);
        $this->assertNull(SecureCode::where('code', $code)->first());
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
