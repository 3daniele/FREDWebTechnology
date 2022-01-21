<?php
class ProductCategoryManager extends DBManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'small_description','price', 'manufacturer_id','category','link');
    $this->tableName = 'productcategory';
  }

  public function search($search)
  {
    return $this->db->query("SELECT DISTINCT id, name, description, small_description, price FROM productcategory WHERE MATCH (name) AGAINST ('$search' IN NATURAL LANGUAGE MODE)
                             UNION SELECT DISTINCT id, name, description, price FROM productcategory WHERE MATCH (category) AGAINST ('$search' IN NATURAL LANGUAGE MODE)");
  }

  public function getByCategory($categoryName){
    return $this->db->query("SELECT *FROM productcategory WHERE category = '$categoryName'");
  }

  public function getNumberOf($categoryName){
    return $this->db->query("SELECT COUNT(id) AS number FROM productcategory WHERE category = '$categoryName'");
  }

  public function getMostPurchased(){
    return $this->db->query("SELECT DISTINCT id, name, description, small_description, price, img FROM productcategory ORDER BY price DESC LIMIT 14");
  }

  public function getCategoryByProduct($productId){
    return $this->db->query("SELECT *FROM productcategory WHERE id = '$productId'");
  }
  
  
}

?>