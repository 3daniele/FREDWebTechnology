<?php

class CategoryManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'description');
    $this->tableName = 'Category';
  }

}
