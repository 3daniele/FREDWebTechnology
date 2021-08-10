<?php

class UserTypeManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'type');
    $this->tableName = 'User_type';
  }

}