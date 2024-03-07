<?php

use App\Models\Ticker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticker_stock_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ticker::class, 'ticker_id');
            $table->dateTime('date');
            $table->double('open');
            $table->double('high');
            $table->double('low');
            $table->double('price')->default(0);
            $table->double('volume');
            $table->double('close');
            $table->unique(['date', 'ticker_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticker_stock_prices');
    }
};
