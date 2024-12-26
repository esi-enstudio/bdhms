<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static when(mixed $search, \Closure $param)
 * @method static search(mixed $search)
 * @method static whereNotNull(string $string)
 * @method static create( array $attr )
 * @method static insert( array[] $array )
 * @method static where()
 * @method static firstWhere()
 */
class Rso extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['user','ddHouse'];

    protected array $searchable = [
        'code',
        'number',
        'pool_number',
        'user.name',
        'user.phone'
    ];

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    /**
     * Relationship with User model
     *
     * @return HasMany
     */
    public function retailer(): HasMany
    {
        return $this->hasMany(Retailer::class);
    }
}
