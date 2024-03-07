<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TickerStockPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        "open",
        "high",
        "low",
        "volume",
        "close",
        "price",
        "ticker_id",
        "date"
    ];

    public function ticker(): BelongsTo
    {
        return $this->belongsTo(Ticker::class);
    }
}
