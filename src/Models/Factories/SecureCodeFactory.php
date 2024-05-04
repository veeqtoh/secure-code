<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Veeqtoh\SecureCode\Classes\CodeGenerator;
use Veeqtoh\SecureCode\Models\SecureCode;

/**
 * @extends Factory<SecureCode>
 */
class SecureCodeFactory extends Factory
{
    protected $model = SecureCode::class;

    public function definition(): array
    {
        $generator = new CodeGenerator();
        $code      = $generator->generate();

        return [
            'code'         => $code,
            'owner_id'     => $this->faker->randomDigit(),
            'allocated_at' => now(),
            'reset_at'     => null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }

    public function deactivated(): SecureCodeFactory
    {
        return $this->state(function () {
            return [
                'reset_at' => now()->subDay(),
            ];
        });
    }

    public function inactive(): SecureCodeFactory
    {
        return $this->state(function () {
            return [
                'allocated_at' => null,
                'reset_at'     => null,
            ];
        });
    }
}