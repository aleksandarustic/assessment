<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticker extends Model
{
    use HasFactory;

    protected $fillable = [
        "symbol",
        "name",
        "type",
        "region",
        "currency"
    ];

    public function stockPrices(): HasMany
    {
        return $this->hasMany(TickerStockPrice::class);
    }
}
