<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @method static pluck(string $string, string $string1)
 * @method static find($id)
 * @method static where(string $string, string $string1)
 * @method static insert(array[] $array)
 */
class House extends Model
{
    use HasSlug;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}



