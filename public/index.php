<?php

use App\Controllers\StartController;

require '../vendor/autoload.php';
require '../bootstrap/bootstrap.php';

Flight::route('POST|GET /', [new StartController, 'start']);

Flight::start();
