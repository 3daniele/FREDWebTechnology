<?php

class CartltemManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'cart_id', 'product_id', 'quantity');
    $this->tableName = 'Cart_item';
  }

}
