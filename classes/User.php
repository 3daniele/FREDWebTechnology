<?php

class UserManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'surname', 'email', 'password', 'img' , 'user_type');
    $this->tableName = 'User';
  }

}