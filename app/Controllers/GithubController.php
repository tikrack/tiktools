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
                self::create($repo, false);
            }

            foreach ($written as $w) {
                if ($id === $w["id"] and ($repo["updated_at"] !== $w["last_update"])) {
                    self::create($repo, true);
                }
            }
        }
    }

    private static function create($repo, $map): void
    {
        $template = "";

        $template .= "<strong>" . $repo["name"] . "</strong> \n\n";

        if (isset($repo["description"])) {
            $template .= $repo["description"] . "\n\n";
        }

        $template .= $repo["html_url"] . "\n\n";

        foreach ($repo["topics"] as $topic) {
            $template .= "#" . $topic . " ";
        }

        if ($map !== true) {
            $message_id = TelegramController::send($template);
        }else {
            TelegramController::update($template, $repo["message_id"]);
        }

        $writtenFile = fopen("../data/Written.json", "r");
        $written = fread($writtenFile, filesize("../data/Written.json"));
        fclose($writtenFile);
        $written = json_decode($written, true);

        if ($map !== true) {
            $written[] = [
                'id' => $repo["id"],
                'last_update' => $repo["updated_at"],
                'message_id' => $message_id
            ];
            $file = fopen('../data/Written.json', 'w');
            fwrite($file, json_encode($written, JSON_PRETTY_PRINT));
            fclose($file);
        }else {
            $newContent = [];
            foreach ($written as $w) {
                if ($w["id"] === $repo["id"]) {
                    $newContent[] = [
                        'id' => $w["id"],
                        'last_update' => $repo["updated_at"],
                        'message_id' => $repo["message_id"],
                    ];
                }else {
                    $newContent[] = $w;
                }
            }
            $file = fopen('../data/Written.json', 'w');
            fwrite($file, json_encode($newContent, JSON_PRETTY_PRINT));
            fclose($file);
        }
    }
}
