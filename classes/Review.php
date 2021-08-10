<?php

class ReviewManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'title', 'message', 'vote', 'user_id', 'product_id');
    $this->tableName = 'Review';
  }

}