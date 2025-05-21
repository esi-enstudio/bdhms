<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $slug)
 * @method static updateOrCreate(array|string[] $array, array $array1)
 * @method static find(mixed $userId)
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'avatar',
        'name',
        'phone_number',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function houses(): BelongsToMany
    {
        return $this->belongsToMany(House::class)->withTimestamps();
    }

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

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()){
            'superadmin'    => $this->hasRole('super_admin'),
            'manager'       => $this->hasRole('manager'),
            'supervisor'    => $this->hasRole('supervisor'),
            'rso'           => $this->hasRole('rso'),
            'bp'            => $this->hasRole('bp'),
            'accountant'    => $this->hasRole('accountant'),
            default => false,
        };
    }
}
