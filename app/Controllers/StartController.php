<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class StartController
{
    public function start(): void
    {
        GithubController::repo();
    }
}
