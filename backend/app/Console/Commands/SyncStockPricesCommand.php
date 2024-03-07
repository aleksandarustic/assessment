<?php

namespace App\Console\Commands;

use App\Actions\Stock\SyncStockPricesAction;
use Illuminate\Console\Command;

class SyncStockPricesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock-prices:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stock prices from external API and import data into DB';

    /**
     * Execute the console command.
     *
     */
    public function handle(SyncStockPricesAction $syncStockPrices)
    {
        $this->info('Beginning of sync-prices');

        $syncStockPrices->handle();

        $this->info('Ending of sync-prices');
    }
}
