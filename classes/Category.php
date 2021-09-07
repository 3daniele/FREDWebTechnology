<?php

class CategoryManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'description');
    $this->tableName = 'Category';
  }

  public function getCategory($id) {
    return $this->db->query("SELECT * FROM Category WHERE id = $id");
  }

  public function getCategoryByName($name){
    return $this->db->query("SELECT id FROM Category WHERE name = '$name'");
  }

}
