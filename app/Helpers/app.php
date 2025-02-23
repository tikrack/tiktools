<?php

use App\Utils\Env;

function env($key): void
{
    Env::get($key);
}