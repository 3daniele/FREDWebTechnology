<?php

class CategoryItemManager extends DbManager
{
//private $categoryid;

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'product_id', 'category_id');
    $this->tableName = 'Category_item';
  }

  public function get_category_id_by_product($product) {
    return $this->db->query("SELECT category_id FROM Category_item WHERE product_id = '$product' LIMIT 3");
  }

  public function get_category_name_by_id($category_id) {
    return $this->db->query("SELECT name FROM Category WHERE id = '$category_id' LIMIT 3");
  }

  public function getProductFromCategory($categoryID){
    return $this->db->query("SELECT product_id FROM Category_item WHERE category_id = '$categoryID'");
  }

}
