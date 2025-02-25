<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GithubController
{
    public static function repo(): void
    {
        $token = env('GITHUB_ACCESS_TOKEN');
        $username = env('GITHUB_USERNAME');

        $client = new Client(['base_uri' => 'https://api.github.com', 'headers' => ['Authorization' => "token {$token}", 'Accept' => 'application/vnd.github.v3+json',],]);

        $page = 1;
        $repositories = [];

        try {
            while (true) {
                $response = $client->get("/users/{$username}/repos", ['query' => ['page' => $page, 'per_page' => 10, 'sort' => 'updated', 'direction' => 'desc',],]);

                $currentRepos = json_decode($response->getBody(), true);

                if (empty($currentRepos)) {
                    break;
                }

                $repositories = array_merge($repositories, $currentRepos);

                $page++;
            }

            self::saveRepo($repositories);
        } catch (RequestException $e) {
            echo 'Error: ' . $e->getMessage();
            if ($e->hasResponse()) {
                echo "\nResponse: " . $e->getResponse()->getBody();
            }
        }
    }

    private static function saveRepo($repos): void
    {
        $tiktools = [];

        foreach ($repos as $repo) {
            if (isset($repo['topics'][0])) {
                $topics = $repo['topics'];

                if (in_array('tiktools', $topics)) {
                    $tiktools[] = $repo;
                }
            }
        }

        $file = fopen('../data/Repos.json', 'w');

        fwrite($file, json_encode($tiktools, JSON_PRETTY_PRINT));

        fclose($file);
    }

    public static function write(): void
    {
        $reposFile = fopen("../data/Repos.json", "r");
        $repos = fread($reposFile, filesize("../data/Repos.json"));
        fclose($reposFile);

        $writtenFile = fopen("../data/Written.json", "r");
        $written = fread($writtenFile, filesize("../data/Written.json"));
        fclose($writtenFile);

        $repos = json_decode($repos, true);
        $written = json_decode($written, true);

        foreach ($repos as $repo) {
            $id = $repo['id'];

            if (!in_array($id, array_column($written, 'id'))) {
                self::create($id);
            }
        }
    }

    private static function create($id): void
    {
        echo "pk";
    }
}
