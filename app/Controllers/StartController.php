<?php

namespace App\Controllers;

class StartController
{
    public function start(): void
    {
//        GithubController::repo();
//        GithubController::write();
        TelegramController::send("hi");
    }
}
