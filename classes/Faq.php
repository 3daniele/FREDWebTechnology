<?php

class FaqManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'title', 'message', 'product_id', 'user_id');
    $this->tableName = 'Faq';
  }

}
