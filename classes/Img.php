<?php

class ImgManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'product_id', 'link', 'thumbnail');
    $this->tableName = 'Photo';
  }

  public function get_thumbnail($product_id){
    $result = $this->db->query("SELECT * FROM Photo WHERE product_id = '$product_id' AND thumbnail=1 LIMIT 1");
    return $result[0];
  }

  public function get_all_photo($product_id){
    return $this->db->query("SELECT * FROM Photo WHERE product_id = '$product_id' AND thumbnail= 0 LIMIT 4");
  }

  /*DASHBOARD*/
  public function getAllImgForAdmin($productID){
    return $this->db->query("SELECT *FROM Photo WHERE product_id = '$productID'");
  }
}