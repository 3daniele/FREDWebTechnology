<?php

class WishlistManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'product_id');
    $this->tableName = 'Wishlist';
  }

}