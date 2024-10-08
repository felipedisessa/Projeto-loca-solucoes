<?php

namespace App\Models;

use App\Helpers\FormatCurrencyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = [
        'formatted_price',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start',
        'end',
        'rental_item_id',
        'status',
        'price',
        'payment_type',
        'paid_at',
    ];

    public static function select(string $string)
    {
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rentalItem(): BelongsTo
    {
        return $this->belongsTo(RentalItem::class);
    }

    public function getFormattedPriceAttribute()
    {
        return FormatCurrencyHelper::formatCurrency($this->price);
    }
}
