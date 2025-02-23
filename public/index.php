<?php

use App\Controllers\StartController;

require '../vendor/autoload.php';

Flight::route('/', [new StartController, "start"]);

Flight::start();
