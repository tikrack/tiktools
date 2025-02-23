<?php

use App\Utils\Env;

function env($key): ?string
{
    return Env::get($key);
}