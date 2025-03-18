<?php

namespace App\Models;

class Repository extends IndexModels
{
    public static function all()
    {
        return static::iAll();
    }

    public static function create($data): void
    {
        static::iCreate($data);
    }

    public static function remove($id): void
    {
        static::iRemove($id);
    }

    public static function find($id)
    {
        return static::iFind($id);
    }
}