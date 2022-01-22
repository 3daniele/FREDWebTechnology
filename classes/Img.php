<?php

class ImgManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'product_id', 'link', 'thumbnail');
    $this->tableName = 'Photo';
  }

  public function get_thumbnail($product_id)
  {
    $result = $this->db->query("SELECT * FROM Photo WHERE product_id = '$product_id' AND thumbnail=1 LIMIT 1");
    return $result[0];
  }

  public function get_all_photo($product_id)
  {
    return $this->db->query("SELECT * FROM Photo WHERE product_id = '$product_id' AND thumbnail= 0 LIMIT 4");
  }

  public function getLast() {
    $result = $this->db->query("SELECT * FROM Photo ORDER BY id DESC");
    return $result[0];
  }

  public function updateImg($imgID, $productID, $number) {
    $img = "/public/img/product/" . $productID . "/" . $number . ".png";
    return $this->db->query("UPDATE Photo SET link = '$img' WHERE id = $imgID");
  }

  public function addImg($productID)
  {
    return $this->db->query("INSERT INTO Photo (product_id, thumbnail) VALUES ($productID, 0)");
  }


  /*DASHBOARD*/
  public function getAllImgForAdmin($productID)
  {
    return $this->db->query("SELECT *FROM Photo WHERE product_id = '$productID'");
  }
}
