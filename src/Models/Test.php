<?php

namespace App\Models;

class Test extends Model
{
    protected static $table = 'test';

    private $name;

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public static function findById($id)
    {
        return static::query()
            ->select('*')
            ->from(static::$table)
            ->where('id', '=', $id)
            ->all();
    }
}