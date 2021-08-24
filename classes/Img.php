<?php

class ImgManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'product_id', 'link', 'thumbnail');
    $this->tableName = 'Answer';
  }

  public function get_thumbnail($product_id){
    return $this->db->query("SELECT * FROM Photo WHERE product_id = '$product_id' AND thumbnail=1 LIMIT 1");
  }
}