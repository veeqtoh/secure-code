<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(config('door-access.connection'))->create('access_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique()->when(
                Schema::getConnection()->getConfig('driver') === 'mysql',
                function (Blueprint $column) {
                    $column->collation('utf8mb4_bin');
                }
            );
            $table->string('owner_id')->nullable();
            $table->timestamp('allocated_at')->nullable();
            $table->timestamp('reset_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('door-access.connection'))->dropIfExists('access_codes');
    }
};
