<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static pluck(string $string, string $string1)
 * @method static find($id)
 * @method static where(string $string, string $string1)
 */
class House extends Model
{
    protected $fillable = [
        'code',
        'slug',
        'name',
        'cluster',
        'region',
        'district',
        'thana',
        'email',
        'address',
        'proprietor_name',
        'contact_number',
        'poc_name',
        'poc_number',
        'lifting_date',
        'status',
        'remarks',
    ];

    protected $with = ['users'];

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}



