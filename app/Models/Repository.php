<?php

namespace App\Models;

class Repository extends IndexModels
{
    public static function all()
    {
        return static::iAll();
    }
}