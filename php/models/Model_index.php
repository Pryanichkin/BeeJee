<?php


namespace php\models;


use php\core\DB;
use php\core\Model;

class Model_index extends Model
{
    public function getData() {
        return DB::query('SELECT username, email, task, is_done FROM tasks');
    }
}