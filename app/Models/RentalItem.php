<?php

namespace App\Models;

use App\Helpers\FormatCurrencyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = [
        'formatted_price_per_hour',
        'formatted_price_per_day',
        'formatted_price_per_month',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price_per_hour',
        'price_per_day',
        'price_per_month',
        'status',
        'rental_item_notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function getFormattedPricePerHourAttribute()
    {
        return FormatCurrencyHelper::formatCurrency($this->price_per_hour);
    }

    public function getFormattedPricePerDayAttribute()
    {
        return FormatCurrencyHelper::formatCurrency($this->price_per_day);
    }

    public function getFormattedPricePerMonthAttribute()
    {
        return FormatCurrencyHelper::formatCurrency($this->price_per_month);
    }
}
