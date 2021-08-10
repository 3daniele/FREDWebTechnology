<?php

class CartManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id');
    $this->tableName = 'Cart';
  }

}