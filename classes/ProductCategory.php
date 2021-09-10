<?php
class ProductCategoryManager extends DBManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'manufacturer_id','category');
    $this->tableName = 'productcategory';
  }

  public function search($search)
  {
    return $this->db->query("SELECT DISTINCT id, name, description, price FROM productcategory WHERE MATCH (name) AGAINST ('$search' IN NATURAL LANGUAGE MODE)
                             UNION SELECT DISTINCT id, name, description, price FROM productcategory WHERE MATCH (category) AGAINST ('$search' IN NATURAL LANGUAGE MODE)");
  }
}

?>