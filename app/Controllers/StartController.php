<?php

namespace App\Controllers;

use App\Models\Repository;

class StartController
{
    public function start(): void
    {
        dd(Repository::all());
    }
}
