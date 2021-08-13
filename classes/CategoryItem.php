<?php

class CategoryItemManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'product_id', 'category_id');
    $this->tableName = 'Category_item';
  }
}
