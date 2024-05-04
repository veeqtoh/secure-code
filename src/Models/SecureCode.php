<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $owner_id
 * @property ?Carbon $allocated_at
 * @property ?Carbon $reset_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SecureCode extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'secure_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'code',
        'owner_id',
        'allocated_at',
        'reset_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'allocated_at' => 'datetime',
        'reset_at'     => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (config('secure-code.connection')) {
            $this->setConnection(config('secure-code.connection'));
        }
    }

    /**
     * @return Factory<SecureCode>
     */
    protected static function newFactory()
    {
        $factoryConfig = config('secure-code.factories');

        $modelFactory = app($factoryConfig[__CLASS__]);

        return $modelFactory::new();
    }

    /**
     * A helper method that can be used for finding a secureCode model with the
     * given code key.
     */
    public static function findByCode(string $code): ?self
    {
        return self::whereCode($code)->first();
    }

    /**
     * A helper method that can be used for finding all the secureCode models
     * with the given owner id.
     *
     * @return Collection<int, SecureCode>
     */
    public static function findByOwnerId(string $ownerId): Collection
    {
        return self::where('owner_id', $ownerId)->get();
    }

    /**
     * Check if the secure code is currently allocated.
     *
     * @return bool Returns true if the secure code is allocated, false otherwise.
     */
    public function isAllocated(): bool
    {
        return isset($this->allocated_at);
    }

    /**
     * Reset the secure code, making it available for reallocation.
     *
     * @return self Returns the secureCode model with the new allocation.
     */
    public function reset(): self
    {
        $this->update([
            'owner_id'     => null,
            'allocated_at' => null,
            'reset_at'     => now(),
        ]);

        return $this->fresh();
    }

    /**
     * Allocate the secure code to an owner.
     *
     * @param string $ownerId The id of the owner to whom the secure code will be allocated.
     *
     * @return self Returns the secureCode model with the new allocation.
     */
    public function allocate(string $ownerId): self
    {
        $this->update([
            'owner_id'     => $ownerId,
            'allocated_at' => now(),
        ]);

        return $this->fresh();
    }

}