<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Veeqtoh\DoorAccess\Classes\CodeGenerator;
use Veeqtoh\DoorAccess\Models\AccessCode;

/**
 * @extends Factory<AccessCode>
 */
class AccessCodeFactory extends Factory
{
    protected $model = AccessCode::class;

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

    public function deactivated(): AccessCodeFactory
    {
        return $this->state(function () {
            return [
                'reset_at' => now()->subDay(),
            ];
        });
    }

    public function inactive(): AccessCodeFactory
    {
        return $this->state(function () {
            return [
                'allocated_at' => null,
                'reset_at'     => null,
            ];
        });
    }
}