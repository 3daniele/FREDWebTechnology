<?php
class ProductCategoryManager extends DBManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'manufacturer_id','category');
    $this->tableName = 'productcategory';
  }

  public function searchByCategory($category)
  {
    return $this->db->query("SELECT * FROM productcategory WHERE category = '$category'");
  }
}

?>