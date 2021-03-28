<?php


namespace php\core;


abstract class Model
{
    abstract public function getData();
    public function addData($data){
        $columns = implode(',', array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";

        return DB::query("INSERT INTO tasks($columns) VALUES($values)") ? json_encode($data) : false;
    }
    public function editData($id, $isEdit, $data){return null;}
}