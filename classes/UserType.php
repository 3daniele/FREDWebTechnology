<?php

class UserTypeManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'type');
    $this->tableName = 'User_type';
  }

  public function getType($userTypeID){
    return $this->db->query("SELECT * FROM User_type WHERE id = '$userTypeID'");
  }

}