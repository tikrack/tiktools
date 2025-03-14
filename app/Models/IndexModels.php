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

        return $db->fetchAll("SELECT * FROM `$instance->name`");
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

    protected static function iCreate($data)
    {
        $instance = new static();
        $instance->setName(get_called_class());
        $db = Flight::db();

//        dd("INSERT INTO `$instance->name` (" . substr(json_encode(array_keys($data)), 1, -1) . ") VALUES ()");
        $lastData = str_replace('"', '`', substr(json_encode(array_keys($data)), 1, -1));
        $values = [];

        for ($i = 0; $i < count($data); $i++) {
            $values[] = "?";
        }

        $values = str_replace('"', '', substr(json_encode(array_values($values)), 1, -1));

        $db->runQuery("INSERT INTO `$instance->name` (" . $lastData . ") VALUES ($values)", ["d", "4"]);
    }
}