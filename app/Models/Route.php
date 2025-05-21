<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Route extends Model
{
    use HasSlug;

    protected $fillable = [
        'slug',
        'code',
        'name',
        'description',
        'length',
        'weekday',
    ];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function () {
                do {
                    $slug = Str::random(10);
                } while (self::where('slug', $slug)->exists());
                return $slug;
            })
            ->saveSlugsTo('slug') // Column to save slug
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    public function retailers(): BelongsToMany
    {
        return $this->belongsToMany(Retailer::class, 'bts_retailer_route', 'route_id', 'retailer_id')
            ->withPivot('bts_id')
            ->withTimestamps();
    }

    public function bts(): BelongsToMany
    {
        return $this->belongsToMany(Bts::class, 'bts_retailer_route', 'route_id', 'bts_id')
            ->withPivot('retailer_id')
            ->withTimestamps();
    }
}
