<?php

class UserManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'surname', 'email', 'password', 'img' , 'user_type');
    $this->tableName = 'User';
  }

  public function login($email, $password) {
    return $this->db->query("SELECT* FROM User WHERE email = '$email' AND password = '$password'");
  }

  public function data($email){
    return $this->db->query("SELECT * FROM User WHERE email = '$email'");
  }
 
}