<?php

use App\Utils\Env;
use App\Utils\Log;

function env($key): ?string
{
    return Env::get($key);
}

function dd($var): string
{
    Log::dd($var);
}