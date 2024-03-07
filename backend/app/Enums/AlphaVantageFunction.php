<?php

namespace App\Enums;

enum AlphaVantageFunction : string
{
    case INTRADAY = "TIME_SERIES_INTRADAY";
    case QUOTE = "GLOBAL_QUOTE";
}
