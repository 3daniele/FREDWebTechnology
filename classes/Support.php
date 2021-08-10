<?php

class SupportManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'status', 'message', 'order_id');
    $this->tableName = 'Support';
  }

}