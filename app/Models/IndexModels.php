<?php

namespace App\Models;

use Flight;

class IndexModels
{
    public $name;

    protected static function iAll()
    {
        $instance = new static();
        $instance->setName(get_called_class());
        $db = Flight::db();

        return $db->fetchAll("SELECT * FROM $instance->name");
    }

    private function setName($className): void
    {
        $this->name = $this->pluralize(strtolower(substr($className, 11)));
    }

    private function pluralize($word): string
    {
        $irregulars = ['child' => 'children', 'foot' => 'feet', 'tooth' => 'teeth', 'goose' => 'geese', 'man' => 'men', 'woman' => 'women', 'person' => 'people', 'mouse' => 'mice', 'sheep' => 'sheep', 'fish' => 'fish', 'species' => 'species',];

        if (array_key_exists(strtolower($word), $irregulars)) {
            return $irregulars[strtolower($word)];
        }

        $rules = ['/(s|sh|ch|x|z)$/i' => '\1es', '/([^aeiou])y$/i' => '\1ies', '/(o)$/i' => '\1es', '/(f|fe)$/i' => 'ves',];

        foreach ($rules as $pattern => $replacement) {
            if (preg_match($pattern, $word)) {
                return preg_replace($pattern, $replacement, $word);
            }
        }

        return $word . 's';
    }
}