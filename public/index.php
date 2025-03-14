<?php

use App\Controllers\StartController;

require '../vendor/autoload.php';

Flight::route('POST /', [new StartController, 'start']);
Flight::route('GET /', [new StartController, 'start']);

Flight::start();
