<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static latest()
 * @method static create(array $attributes)
 * @method static when(mixed $search, \Closure $param)
 * @method static search(mixed $search)
 * @method static insert()
 * @method static where()
 * @method static firstWhere()
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $lifting_date
 * @property mixed $disabled_at
 */
class DdHouse extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected array $searchable = [
        'name',
        'code',
    ];

    /**
     * Relationship with User model
     *
     */
    public function rso(): HasMany
    {
        return $this->hasMany(Rso::class);
    }

    public function liftings(): HasMany
    {
        return $this->hasMany(Lifting::class);
    }
}
