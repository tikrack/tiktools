<?php

namespace App\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TelegramController
{
    public static function send($message): mixed
    {
        $token = env("TELEGRAM_BOT_TOKEN");
        $channelUsername = env("TELEGRAM_CHANNEL_ID");

        $client = new Client();
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        try {
            $result = $client->post($url, ['form_params' => ['parse_mode' => "HTML", 'chat_id' => $channelUsername, 'text' => $message]]);
            return json_decode($result->getBody(), true)["result"]["message_id"];
        } catch (Exception $e) {
            dd($e->getMessage());
        } catch (GuzzleException $e) {
            dd($e);
        }
    }

    public static function update($message, $message_id): mixed
    {
        $token = env("TELEGRAM_BOT_TOKEN");
        $channelUsername = env("TELEGRAM_CHANNEL_ID");

        $client = new Client();
        $url = "https://api.telegram.org/bot{$token}/editMessageText";

        try {
            $client->post($url, ['form_params' => ['parse_mode' => "HTML", 'chat_id' => $channelUsername, 'message_id' => $message_id, 'text' => $message]]);
        } catch (Exception $e) {
            dd($e->getMessage());
        } catch (GuzzleException $e) {
            dd($e);
        }
    }
}
