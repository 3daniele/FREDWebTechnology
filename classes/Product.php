<?php

class ProductManager extends DbManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'manufacturer_id');
    $this->tableName = 'Product';
  }
}
