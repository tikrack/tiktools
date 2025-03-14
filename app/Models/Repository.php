<?php

namespace App\Models;

class Repository extends IndexModels
{
    public static function all()
    {
        return static::iAll();
    }

    public static function create($data)
    {
        return static::iCreate($data);
    }
}