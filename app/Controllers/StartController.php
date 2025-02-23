<?php

namespace App\Controllers;

class StartController
{
    public function start(): void
    {
        echo dd([
            "hi" => "hello",
            "hey" => "by"
        ]);
    }
}
