<?php

class ProductManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'images', 'manufaturer_id', 'category_id');
    $this->tableName = 'Product';
  }

}
