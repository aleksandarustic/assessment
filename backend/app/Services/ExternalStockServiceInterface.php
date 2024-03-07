<?php

namespace App\Services;

use App\DTO\AlphaVantageDtoInterface;

interface ExternalStockServiceInterface
{
    public function callAsPool(array $calls): array;

    public function call(AlphaVantageDtoInterface $input): array;
}
