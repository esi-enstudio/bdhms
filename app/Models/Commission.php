<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @method static search( mixed $search )
 * @method static create( array $attributes )
 * @method static where( array[] $array )
 * @property mixed $month
 * @property mixed $receive_date
 */
class Commission extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['ddHouse','user','rso','retailer','manager','supervisor'];
    protected $appends = ['month_name','receive','c_type','c_status','taka'];

    protected array $searchable = [
        'for',
        'name',
        'type',
        'amount',
        'ddHouse.name',
        'ddHouse.code',
    ];

    // Accessor for formatted_date
    public function getMonthNameAttribute(): string
    {
        return Carbon::parse($this->month)->format('M Y');

    }

    // Accessor for formatted_date
    public function getReceiveAttribute(): string
    {
        return Carbon::parse($this->receive_date)->toFormattedDayDateString();

    }

    // Accessor for formatted_date
    public function getCTypeAttribute(): string
    {
        return Str::title(implode(' ', explode('_',$this->type)));

    }
    // Accessor for formatted_date
    public function getCStatusAttribute(): string
    {
        return Str::title($this->status);

    }
    // Accessor for formatted_date
    public function getTakaAttribute(): string
    {
        return number_format($this->amount, 0, '.', ',') . ' Tk';

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function zm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'zm');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor');
    }

    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }

    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class);
    }
}
