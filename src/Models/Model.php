<?php

namespace App\Models;

use App\Utils\QueryBuilder;

class Model
{
    protected static $table;
    protected $id;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public static function query(): QueryBuilder
    {
        return new QueryBuilder(static::class);
    }
}