<?php

namespace App\Utils;

class Env
{
    public static function get($key): ?string
    {
        $file = fopen(__DIR__ . "/../../" . '.env', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (empty($line) || $line[0] == '#') {
                    continue;
                }
                [$k, $v] = explode('=', $line, 2);
                $k = trim($k);
                $v = trim($v);
                if ($k == $key) {
                    fclose($file);

                    return $v;
                }
            }
            fclose($file);
        }

        return null;
    }
}
