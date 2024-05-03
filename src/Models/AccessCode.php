<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Models;

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
class AccessCode extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
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

        if (config('door-access.connection')) {
            $this->setConnection(config('door-access.connection'));
        }
    }

    /**
     * @return Factory<AccessCode>
     */
    protected static function newFactory()
    {
        $factoryConfig = config('door-access.factories');

        $modelFactory = app($factoryConfig[__CLASS__]);

        return $modelFactory::new();
    }

    /**
     * A helper method that can be used for finding a AccessCode model with the
     * given code key.
     */
    public static function findByCode(string $code): ?self
    {
        return self::where('code', $code)->first();
    }

    /**
     * A helper method that can be used for finding all the AccessCode models
     * with the given owner id.
     *
     * @return Collection<int, AccessCode>
     */
    public static function findByOwnerId(string $ownerId): Collection
    {
        return self::where('owner_id', $ownerId)->get();
    }
}