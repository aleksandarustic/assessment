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

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

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
                "symbol" => "63TA.FRK",
                "name" => "Tencent Music Entertainment Group",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "IMB.LON",
                "name" => "Imperial Brands PLC",
                "type" => "Equity",
                "region" => "United Kingdom",
                "currency" => "GBX"
            ],
            [
                "symbol" => "IMBAX",
                "name" => "VOYA LIMITED MATURITY BOND PORTFOLIO CLASS ADV",
                "type" => "Mutual Fund",
                "region" => "United States",
                "currency" => "USD"
            ],
            [
                "symbol" => "IMBB11.SAO",
                "name" => "Etf Bradesco Ima-B Fundo De Indice",
                "type" => "ETF",
                "region" => "Brazil/Sao Paolo",
                "currency" => "BRL"
            ],
            [
                "symbol" => "TSCO.LON",
                "name" => "Tesco PLC",
                "type" => "Equity",
                "region" => "United Kingdom",
                "currency" => "GBX"
            ],
            [
                "symbol" => "TSCO",
                "name" => "Tractor Supply Company",
                "type" => "Equity",
                "region" => "United States",
                "currency" => "USD"
            ],
        ]);


    }
}
