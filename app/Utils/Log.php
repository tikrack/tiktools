<?php

namespace App\Utils;

class Log {
    public static function dd($value): string
    {
        static $template;

        $template .= "<pre>";
        $template .= print_r($value, true);
        $template .= "</pre>";

        die($template);
    }
}