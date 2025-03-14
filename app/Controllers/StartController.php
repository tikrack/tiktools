<?php

namespace App\Controllers;

use App\Models\IndexModels;
use App\Models\Repository;
use Flight;

class StartController
{
    public function start(): void
    {
        $rep = new Repository();
        $rep->test();
    }
}
