<?php


namespace php\models;


use php\core\DB;
use php\core\Model;

class Model_admin extends Model
{

    public function getData() {
        return DB::query('SELECT id, username, email, task, is_done, is_edit FROM tasks');
    }

    public function editData($id, $isEdit, $data) {

        $fieldName = array_key_first($data);
        $fieldValue = $data[$fieldName];
        $isEditText = $isEdit ? ", is_edit = '$isEdit'" : "";

        return DB::query("UPDATE tasks SET $fieldName = '$fieldValue' $isEditText WHERE id = $id") ? $fieldValue : false;
    }
}