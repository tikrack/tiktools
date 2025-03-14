<?php

namespace App\Models;

class Repository extends IndexModels
{
    public function test()
    {
        $this->logCaller();
    }
}