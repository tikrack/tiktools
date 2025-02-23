<?php

namespace App\Controllers;

class StartController
{
    public function start(): void
    {
        echo env('APP_NAME');
    }
}
