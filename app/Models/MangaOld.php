<?php

namespace App\Models;

class MangaOld
{
    protected $data;

    /** @var array safe no update no delete */
    protected static $safe = ['id','created_at','updated_at'];

    /** @var array required fields */
    protected static $required = ['title'];

    public function __construct(array $params)
    {
        foreach(array_keys($params) as $key){
            $this->data->$key = $params[$key];
        }
    }

    public function __set(string $name, $value): void
    {
        if(empty($this->data)){
            $this->data = new \StdClass();
        }
        $this->data->$name = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data->$name);
    }

    /***
     * If name isset of data then returns it otherwise returns null
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return ($this->data->$name ?? null);
    }

    /**
     * @return null|object
     */
    public function data(): ?object
    {
        return $this->data;
    }

    public function read($query,$params)
    {
        return "PDO todo";
    }

    public function find(string $terms, string $params, string $col = "*")
    {
        $q = $this->read("SELECT {$col} FROM " . self::$entity . " WHERE {$terms}", $params);


        return $q;
    }

    public function insert()
    {

    }

    public function remove()
    {

    }
}
