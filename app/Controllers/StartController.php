<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class StartController
{
    /**
     * @throws GuzzleException
     */
    public function start(): void
    {
        $client = new Client();

        $response =  $client->get("https://api.salamlang.ir/api/v1/code");

        $result = $response->getBody();

        dd($result);
    }
}
