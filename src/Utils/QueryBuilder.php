<?php

namespace App\Utils;

use PDO;

class QueryBuilder
{
    private $db;
    private $model;

    private $select = '*';
    private $table;
    private $where = [];
    private $orderBy = [];
    private $limit;
    public function __construct($model)
    {
        $this->model = $model;
        $this->db = Database::getPDO();
    }

    public function select($columns): QueryBuilder
    {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->where[] = compact('column', 'operator', 'value');
        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $logical = 'AND ';
        $this->where[] = compact('column', 'operator', 'value', 'logical');
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $logical = 'OR ';
        $this->where[] = compact('column', 'operator', 'value', 'logical');
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $direction = strtoupper($direction);
        $this->orderBy[] = compact('column', 'direction');
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    private function buildWhereClause()
    {
        $wheres = [];
        $and_or = '';
        foreach ($this->where as $condition) {
            if ($wheres)
                $and_or = $condition['logical'];
            $wheres[] = "{$and_or}{$condition['column']} {$condition['operator']} '{$condition['value']}'";
        }

        return implode(' ', $wheres);
    }

    private function buildOrderByClause()
    {
        $ordersBy = [];
        foreach ($this->orderBy as $order) {
            $ordersBy[] = "{$order['column']} {$order['direction']}";
        }
        return implode(', ', $ordersBy);
    }

    public function get()
    {
        if (empty($this->table)) {
            dump('La table n\'est pas spécifié.');
        }

        $query = "SELECT {$this->select} FROM `{$this->table}`";

        if (!empty($this->where)) {
            $query .= " WHERE " . $this->buildWhereClause();
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . $this->buildOrderByClause();
        }

        $statement = $this->db->query($query);

        return $statement->fetchObject($this->model);
    }

    public function all()
    {
        if (empty($this->table)) {
            dump('La table n\'est pas spécifié.');
        }

        $query = "SELECT {$this->select} FROM `{$this->table}`";

        if (!empty($this->where)) {
            $query .= " WHERE " . $this->buildWhereClause();
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . $this->buildOrderByClause();
        }

        if (!is_null($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        $statement = $this->db->query($query);

        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }
}