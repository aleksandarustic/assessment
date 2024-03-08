<?php

namespace Database\Seeders;

use App\Models\Ticker;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Ticker::insert([
            [
                "symbol" => "BA",
                "name" => "Boeing Company",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "BAB",
                "name" => "INVESCO TAXABLE MUNICIPAL BOND ETF ",
                "type" => "ETF",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "SAIC",
                "name" => "Science Applications International Corp",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "TME",
                "name" => "Tencent Music Entertainment Group",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "SHOP",
                "name" => "Shop Group",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "IBM",
                "name" => "Imperial Brands PLC",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "AAPL",
                "name" => "VOYA LIMITED MATURITY BOND PORTFOLIO CLASS ADV",
                "type" => "Mutual Fund",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "INTC",
                "name" => "INTC group",
                "type" => "ETF",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "TSCO",
                "name" => "Tesco PLC",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "HOG",
                "name" => "HOG Company",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
        ]);


    }
}
