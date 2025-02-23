<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GithubController
{
    public static function repo(): void
    {
        $token = env("GITHUB_ACCESS_TOKEN");
        $username = env("GITHUB_USERNAME");

        $client = new Client([
            'base_uri' => 'https://api.github.com',
            'headers' => [
                'Authorization' => "token {$token}",
                'Accept' => 'application/vnd.github.v3+json',
            ],
        ]);

        $page = 1;
        $repositories = [];

        try {
            while (true) {
                $response = $client->get("/users/{$username}/repos", [
                    'query' => [
                        'page' => $page,
                        'per_page' => 10,
                    ],
                ]);

                $currentRepos = json_decode($response->getBody(), true);

                if (empty($currentRepos)) {
                    break;
                }

                $repositories = array_merge($repositories, $currentRepos);

                $page++;
            }

            self::saveRepo($repositories);
        } catch (RequestException $e) {
            echo "Error: " . $e->getMessage();
            if ($e->hasResponse()) {
                echo "\nResponse: " . $e->getResponse()->getBody();
            }
        }
    }

    private static function saveRepo($repos): void
    {
        $file = fopen("../data/Repos.json", "w");
        fwrite($file, json_encode($repos, JSON_PRETTY_PRINT));
        fclose($file);
    }
}