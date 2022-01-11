<?php

class WishlistManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id', 'product_id');
    $this->tableName = 'Wishlist';
  }

  public function getByUserId($userID)
  {
    return $this->db->query("SELECT * FROM Wishlist WHERE user_id = $userID");
  }

  public function countElementByUser($userID)
  {
    return $this->db->query("SELECT COUNT(product_id) AS countid FROM Wishlist WHERE user_id = $userID");
  }

  public function deleteByProductId($productID, $userID)
  {
    $this->db->query("DELETE FROM Wishlist WHERE user_id = $userID AND product_id = $productID");
  }

  public function addProduct($userID, $productID)
  {

    $newId = $this->create([
      'user_id' => $userID,
      'product_id' => $productID,
    ]);
  }
}
