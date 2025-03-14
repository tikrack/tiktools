<?php

namespace App\Models;

class IndexModels
{
    public $name;

    public function __construct()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $name = substr($backtrace[1]["class"], 11);
        $name = strtolower($name);
    }

    function pluralize($word) {
        $irregulars = [
            'child' => 'children',
            'foot' => 'feet',
            'tooth' => 'teeth',
            'goose' => 'geese',
            'man' => 'men',
            'woman' => 'women',
            'person' => 'people',
            'mouse' => 'mice',
            'sheep' => 'sheep',
            'fish' => 'fish',
            'species' => 'species',
        ];

        if (array_key_exists(strtolower($word), $irregulars)) {
            return $irregulars[strtolower($word)];
        }

        $rules = [
            '/(s|sh|ch|x|z)$/i' => '\1es',
            '/([^aeiou])y$/i' => '\1ies',
            '/(o)$/i' => '\1es',
            '/(f|fe)$/i' => 'ves',
        ];

        foreach ($rules as $pattern => $replacement) {
            if (preg_match($pattern, $word)) {
                return preg_replace($pattern, $replacement, $word);
            }
        }

        return $word . 's';
    }

    protected function logCaller() {

    }
}